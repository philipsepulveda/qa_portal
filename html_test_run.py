import re
import sys
from bs4 import BeautifulSoup


def print_results(directory):
    bddfyfile = open(directory)
    soup = BeautifulSoup(bddfyfile.read(), "html.parser")
    tested = soup.find(string=re.compile("Tested"))
    print tested[11:33]


if __name__ == "__main__":
    print_results(sys.argv[1])
