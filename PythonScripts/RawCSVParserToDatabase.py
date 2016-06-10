#!/usr/bin/python
from datetime import datetime
import csv, requests, json, unicodedata, sys, os , commands

def filterLine(line):
	r = []
	r.extend((line[0],formatDate(line[1]),formatDate(line[2])))
	return r

def formatDate(date):
	return datetime.strptime(date.lstrip(), '%Y-%m-%d %H:%M:%S').strftime('%a %b %d %H:%M:%S %Y')

def getMAC(MACADDRESS):
	x = requests.get('http://macvendors.co/api/' + MACADDRESS).json()
	if u'error' not in x[u'result']:
		return unicodedata.normalize('NFKD', x[u'result'][u'company']).encode('ascii','ignore')	
	elif u'error' in x[u'result']:
		return "Unknown"

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
				writer = csv.writer(wf)
				for line in lines:
					row = []
					if len(line) > 1:
						row = filterLine(line)
						row.extend((getMAC(line[0]),myMAC("eth0")))
						print row
						#push into databse from here on out

