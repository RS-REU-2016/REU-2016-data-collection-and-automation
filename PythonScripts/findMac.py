import os, commands

def myMAC(iface):
	words = commands.getoutput("ifconfig" + iface).split()
	if "HWaddr" in words:
		return words[words.index("HWaddr") + 1]
	else:
		return 'NULL'



print myMAC("wlan0")