from datetime import datetime

Datetime = "2016-06-09 15:25:27"

newtime = datetime.strptime(Datetime, '%Y-%m-%d %H:%M:%S').strftime('%a %b %d %H:%M.%S %Y')
print newtime
