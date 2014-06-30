Joomla System Plugin Facebookfix
===========

Joomla fix on gzip-facebook share

Facebook scraper gets only 40kb of data when scraping a page. If Gzip is enabled and the compressed page is more than that Facebook gets something that cannot decode (partial d/l returns code 206). 

This plugin checks if user agent is facebookexternalhit/1.1 and if so disables the gzip
