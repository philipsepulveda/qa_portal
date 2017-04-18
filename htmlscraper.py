import sys
from bs4 import BeautifulSoup


def print_results(directory):
    summary = ""
    bddfyfile = open(directory)
    soup = BeautifulSoup(bddfyfile.read(), "html.parser")
    label = soup.find_all("div", {"class": "summaryLine"})
    for labelResult in label:
        summary += (labelResult.find_all("div", {"class": "summaryLabel"})[0].text + ": " + labelResult.find_all("span", {"class": "summaryCount"})[0].text + " | ")
    print summary[:len(summary) - 3]


if __name__ == "__main__":
    print_results(sys.argv[1])
