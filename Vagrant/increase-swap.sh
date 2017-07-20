#!/bin/sh

# size of swapfile in megabytes
swapsize=8192000

# does the swap file already exist?
grep -q "swapfile" /etc/fstab

# if not then create it
if [ $? -ne 0 ]; then
 sudo dd if=/dev/zero of=/swapfile1 bs=1024 count=swapsize
 sudo chown root:root /swapfile1
 sudo chmod 0600 /swapfile1
 sudo mkswap /swapfile1
 sudo swapon /swapfile1
 echo '/swapfile1 none swap defaults 0 0' >> /etc/fstab
else
  echo 'swapfile found. No changes made.'
fi

# output results to terminal
df -h
cat /proc/swaps
cat /proc/meminfo | grep Swap
