import requests
import re
from lxml import etree

URL = 'https://www.asahi.com/rss/asahi/newsheadlines.rdf'

current_newsfeed = requests.get(URL)

current_newsfeed.encoding = current_newsfeed.apparent_encoding

def getListOfLinks(currentRDF):
    list_of_items = []
 
    for line in currentRDF.text.split('\n'):
        
        if line.find('<item') != -1:
            list_of_items.append({'title': '', 'link': ''})     
        
        if line.find('<title') != -1 and len(list_of_items) > 1:
            list_of_items[-1]['title'] = re.search(r"[>](.*)[<]", line)[1]
            print(list_of_items[-1]['title'])
        if line.find('<link') != -1 and len(list_of_items) > 1:
            list_of_items[-1]['link'] = re.search(r"[>](.*)[<]", line)[1]
            print(list_of_items[-1]['link'])


    return list_of_items

if __name__ == "__main__":
    listOfLinks = getListOfLinks(current_newsfeed)

    #print(listOfLinks)

    print(f"url: {listOfLinks[1]['link']}")
    
    first_rss_link = requests.get( listOfLinks[1]['link'] )

    print(first_rss_link.text)

    RSS = etree.HTML(first_rss_link.content)

    print(RSS)
