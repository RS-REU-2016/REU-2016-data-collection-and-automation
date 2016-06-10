import pprint
import csv
import requests
import json

API = 'http://macvendors.co/api/%s'

with open('parsedfile.csv' , 'r') as macfile:
	MACS = csv.reader(macfile)
	for mac in MACS:
		r = requests.get(API % mac[0])
		x = r.json()
		if u'error' not in x[u'result']:
			print x[u'result'][u'company']

