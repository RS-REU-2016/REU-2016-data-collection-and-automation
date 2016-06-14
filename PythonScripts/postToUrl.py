#!/usr/bin/python
from datetime import datetime
import csv, requests, json, unicodedata, sys, os , commands, urllib


#name of RaspNode
url = "http://localhost/index.php"

def filterLine(line):
	r = []
	r.extend((line[0],formatDate(line[1]),formatDate(line[2])))
	return r

def formatDate(date):
	return datetime.strptime(date.lstrip(), '%Y-%m-%d %H:%M:%S').strftime('%a %b %d %H:%M:%S %Y')

def getMAC(MACADDRESS):
	#one api   http://searchmac.com/api/raw/
	#second api   http://macvendors.co/api/
	#third option http://api.macvendors.com/
	API = 'http://api.macvendors.com/%s'
	vendor = urllib.urlopen(API % MACADDRESS).read()
	if len(vendor) > 1:
		return vendor
	else:
		return "Unkown"

def myMAC(iface):
	words = commands.getoutput("ifconfig" + iface).split()
	if "HWaddr" in words:
		return words[words.index("HWaddr") + 1]
	else:
		return 'NULL'

with open('file.csv' , 'rb') as csvfile:
	lines = csv.reader(csvfile)
	lines.next()
	for line in lines:
		if len(line) > 1:
			if "Station" in line[0]:
				lines.next()
				for line in lines:
					if len(line) > 1:
						#row.extend((getMAC(line[0]),myMAC("eth0")))
						payload = {'node' : 'node1' , 'mac' : line[0] , 'firstseen': formatDate(line[1]) , 'lastseen' : formatDate(line[2]), 'company' : getMAC(line[0]) }
						#print payload
						r = requests.post(url , data=payload)
						print r.text