import pprint
import csv
import requests
import json
import urllib

API = 'http://api.macvendors.com/%s'

with open('ParsedData.csv' , 'r') as macfile:
	MACS = csv.reader(macfile)
	for mac in MACS:
		u = urllib.urlopen(API % mac[0])
		print u.read()
