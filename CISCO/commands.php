Troubleshooting  commands
$ ifconfig
$ ifconfig eth0

Command for Identify which process consuming more load 
$ ps -o pid,user,%mem,command ax | sort -b -k3 -r
OR
grep processor /proc/cpuinfo | wc -l


Commadn for  Minimize server load 
1.kill the process which not in use. 





