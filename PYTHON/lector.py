import urllib.request

page = urllib.request.urlopen("https://www.bondesque.com/blogs/bondesque-blog/pet-play-101-the-beginners-guide-to-the-pet-play-k/")
print(page.read())