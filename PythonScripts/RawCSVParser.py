import csv
from datetime import datetime
import pprint
import requests
import json
import unicodedata


def filterLine(line):
	r = []
	r.extend((line[0],formatDate(line[1]),formatDate(line[2])))
	return r

def formatDate(date):
	return datetime.strptime(date.lstrip(), '%Y-%m-%d %H:%M:%S').strftime('%a %b %d %H:%M.%S %Y')

def getMAC(MACADDRESS):
	API = 'http://macvendors.co/api/%s'
	r = requests.get(API % MACADDRESS)
	x = r.json()
	if u'error' not in x[u'result']:
		ret = unicodedata.normalize('NFKD', x[u'result'][u'company']).encode('ascii','ignore')
		return ret
	elif u'error' in x[u'result']:
		return "Unknown"

with open('file.csv' , 'rb') as csvfile:
	lines = csv.reader(csvfile)
	lines.next()
	for line in lines:
		if len(line) > 1:
			if "Station" in line[0]:
				lines.next()
				print line[0]
				with open('ParsedData.csv' , 'wb') as wf:
					writer = csv.writer(wf)
					for line in lines:
						row = []
						if len(line) > 1:
							row = filterLine(line)
							row.append(getMAC(line[0]))
							print row
							writer.writerow(row)

