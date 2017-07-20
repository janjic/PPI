#!/bin/bash
sudo chown -R $USER:www-data ~/.npm
sudo chown -R $USER:www-data ~/.config
sudo chown -R $USER:www-data ~/.cache/bower
sudo find src -type d -name "node_modules" | xargs chown -R $USER:www-data
sudo find src -type d -name "node_modules" | xargs chmod ag+rw
sudo find src -type d -name "bower_components" | xargs chown -R $USER:www-data
sudo find src -type d -name "bower_components" | xargs chmod ag+rw
# Go to project root
cd ${0%/*}/..
console_path=bin/console
cache_path=/usr/share/fsddev-app/cache
read showOptions stopPropagation frontendTheme backendTheme buildFTheme buildBTheme loadFromDb generateCss pluginChange singleAssetDump singleAssetDumpValue pluginChangeValue redisClear<<<$(echo false false "FShop" "Empire-Backend" false false "--fromDB" false false false)
source ${0%/*}/default_deploy_params.sh 2> /dev/null
[[ "$(uname)" == "Darwin" ]] && prefix='\\x1B' || prefix='\\e'
read background bold reset info <<<$(echo "${prefix}[41m" "${prefix}[1;37m" "${prefix}[0m" "${prefix}[44m")
for ARGUMENT in "$@"
do
    KEY=$(echo $ARGUMENT | cut -f1 -d=)
    VALUE=$(echo $ARGUMENT | cut -f2 -d=)
    case "$KEY" in
            ftheme)              frontendTheme=${VALUE} ;;
            btheme)              backendTheme=${VALUE} ;;
            --build-ftheme)      buildFTheme=true ;;
            --build-btheme)      buildBTheme=true ;;
            --build-css)         generateCss=true ;;
            --plugin-change)     pluginChangeValue=${VALUE} pluginChange=true ;;
            --single-plugin)     singleAssetDumpValue=${VALUE} singleAssetDump=true ;;
            --no-database)       loadFromDb="" ;;
            --rclear)            redisClear="--no-interaction" ;;
            --help)              showOptions=true ;;
            *)                   echo -e "${background}  There is no paramater '$KEY'. Did you mean: ${bold}ftheme, btheme, --build-ftheme, --build-btheme, --build-css, --plugin-change, --single-plugin, --rclear ${reset}" ; exit 1; ;;
    esac
done
setPermissions() {
    sudo find src -maxdepth 3 -type d -name "node_modules" | xargs chgrp -R www-data
    sudo find src -maxdepth 3 -type d -name "node_modules" | xargs chmod -R g+rw
    sudo find src -maxdepth 3 -type d -name "bower_components" | xargs chgrp -R www-data
    sudo find src -maxdepth 3 -type d -name "bower_components" | xargs chmod -R g+rw
    sudo chgrp -Rf www-data /var/www/{.cache,.config,.locale,.npm}
    sudo chmod -Rf g+rwx /var/www/{.cache,.config,.locale,.npm}
    sudo chgrp www-data /var/www
    sudo chmod g+rw /var/www
}
if ${showOptions}; then
    echo -e "${info}  Available options: ${bold}ftheme, btheme, --build-ftheme, --build-btheme, --build-css, --plugin-change, --rclear ${reset}" ; exit 1;
fi
if ${buildFTheme}; then
    sudo rm -rf ${cache_path}
    php7.0 ${console_path} empire-cli:theme_install --env=prod --no-debug
    sudo rm -rf ${cache_path}
    stopPropagation=true
fi
if ${buildBTheme}; then
    rm -rf ${cache_path}
    php7.0 ${console_path} empire-cli:backend_theme_install --env=prod --no-debug
    rm -rf ${cache_path}
    stopPropagation=true
fi
if ${pluginChange}; then
    sudo rm -rf ${cache_path}

    php7.0 ${console_path} empire-cli:plugins:generate:config:files --change=${pluginChangeValue} --env=prod --no-debug


    sudo rm -rf ${cache_path}
    php7.0 ${console_path} empire-cli:assets_install_plugins_all --for-plugins=${pluginChangeValue} --env=prod --no-debug
    sudo rm -rf ${cache_path}
    php7.0 ${console_path} empire-cli:plugins:cache-layouts --env=prod --no-debug
    stopPropagation=true
fi
if ${generateCss}; then
    sudo rm -rf ${cache_path}
    php7.0 ${console_path} empire-cli:single-plugin-assetic:dump theme_fashion_css --env=prod --no-debug
    stopPropagation=true
fi
if ${singleAssetDump}; then
    sudo rm -rf ${cache_path}
    php7.0 ${console_path} empire-cli:single-plugin-assetic:dump ${singleAssetDumpValue} --env=prod --no-debug
    stopPropagation=true
fi
if ${stopPropagation}; then
#    setPermissions
    sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app; sudo chown -R www-data:www-data /usr/share/fsddev-app;
    exit 1
fi
sudo rm -f /usr/bin/bower; sudo ln -s $(which bower) /usr/bin
sudo rm -f /etc/sudoers.d/bower; sudo touch /etc/sudoers.d/bower
sudo echo 'www-data ALL = NOPASSWD: /usr/bin/bower' | sudo tee /etc/sudoers.d/bower > /dev/null
bower install --allow-root --force;
sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app; sudo chown -R vagrant:www-data /usr/share/fsddev-app;
rm -f app/config/{plugin,theme}_settings.yml app/config/plugin_routes.yml
touch app/config/{plugin,theme}_settings.yml app/config/plugin_routes.yml
sudo rm -rf web/Resource/*
php7.0 ${console_path} redis:flushall ${redisClear}
php7.0 ${console_path} empire-cli:plugins:generate:config:files --ftheme=${frontendTheme} ${loadFromDb} --env=prod --no-debug
rm -rf ${cache_path}
php7.0 ${console_path} empire-cli:themes:generate:config:files --ftheme=${frontendTheme} --btheme=${backendTheme} --env=prod --no-debug
rm -rf ${cache_path}

php7.0 ${console_path} empire-cli:generate_theme_css ${frontendTheme} --env=prod --no-debug
rm -rf ${cache_path}
php7.0 ${console_path} empire-cli:deploy --ftheme=${frontendTheme} --btheme=${backendTheme} --env=prod --no-debug
#setPermissions
sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app; sudo chown -R www-data:www-data /usr/share/fsddev-app;