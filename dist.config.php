<?php

const WEB_URL = '/tools/rss_view/?';

// Each entry in this array should be a full URL to an RSS feed.
const URLS = [
	"https://rickhanson.com/feed/"
];

// Each entry in this array should be a string to search within each post from the corresponding feed above (by index).
// If the string does not exist, that post will not be included in the displayed output. You can use this to filter the
// posts that are displayed for each feed as desired. To include all posts, set the search value for that feed to a
// blank string: ''.
const SEARCH = [
	"Meditation + Talk"
];
