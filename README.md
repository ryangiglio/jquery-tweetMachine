# jQuery Tweet Machine
A jQuery plugin that allows you to create a streaming Twitter feed using their new REST API v1.1. Roll your own backend or use one of the sample implementations (currently PHP only, Ruby and Python coming soon) to get up and running as fast as possible.

## About
With a forced switch to Twitter API v1.1 on the horizon (March 5th, 2013), it's no longer possible to make any unauthenticated calls. This means you now need a backend component to perform what was once possible with pure Javascript (lest exposing your secret keys), and unfortunately also means the end of the road for some wonderful and easy to implement jQuery plugins.

I've been a huge fan of [jQuery LiveTwitter](http://elektronaut.github.com/jquery.livetwitter/) by [elektronaut](https://github.com/elektronaut) for years now, but it would have to be reworked to include a server side component. In my development of [The Social Prompter](http://thesocialprompter.com/) I needed to come up with a futureproof solution, so I decided to rewrite the plugin with a roll-your-own backend setup.

A huge amount of credit goes to [elektronaut](https://github.com/elektronaut), since a great deal of his code has found its way into this plugin. I've added some new features (or rather plan to add some new features) beyond the backend section, but Tweet Machine is jQuery LiveTwitter v2.0 in spirit.

## Javascript setup
The Javascript portion of Tweet Machine is quite simple to set up. Simply call the .tweetMachine function on an empty container:

    $('#tweets').tweetMachine('#bieber');

By default, the plugin uses a backend script located at `/ajax/getFromTwitter.php`. This is the sample script that is provided and should be sufficient for most LAMP implementations. If you would like to use your own script or save it in a different folder, you can do that using the backendScript option:

    $('#tweets').tweetMachine('#bieber',
        { backendScript: '/inc/newBackend.php' }
    );

A complete list of options is at the bottom of this readme

## Backend setup
Complete instructions for setting up the sample backend script is located in the `ajax/getFromTwitter.php` file. If you'd like to roll your own script, simply ensure that it returns the JSON array of tweets that you get back from the Twitter API.

Sample scripts in different languages are coming soon. If you're interested in creating one, please feel free!

## Options
    // Path to your backend script that holds your Twitter credentials and calls the API
    backendScript:  '/ajax/getFromTwitter.php'

    // Twitter API endpoint to call. Currently only search/tweets is supported
    endpoint:       'search/tweets'

    // Rate in ms to refresh the tweets. The 'search/tweets' endpoint has a rate limit of 180 calls per 15 minutes,
    // so any higher than 5000 will get you rate limited
    rate:           5000

    // Number of tweets to display at a time
    limit:          5

    // Number of tweets to get from Twitter per request. By default this is the same as the number of tweets displayed,
    // but increase it if you're filtering tweets so you don't come up short in case some get filtered out
    requestLimit:   limit          

    // CURRENTLY REQUIRED. Auto-refresh the tweets
    autoRefresh:    true

    // NOT YET SUPPORTED. Animate out old tweets
    animateOut:     false

    // Fade in new tweets
    animateIn:      true 

    // Format for the tweet objects. Any structure will work, but the class names are required
    tweetFormat: // Format for each tweet
        "<li class='tweet'>
            <img class='avatar' src=''/>
            <div class='meta'>
                <a href='' class='username'></a>
                <a href='' class='time'></a>
            </div>
            <p class='content'></p>
        </li>"

    // Verbiage to use for timestamps
    localization: { 
        seconds:    'seconds ago',
        minute:     'a minute ago',
        minutes:    'minutes ago',
        hour:       'an hour ago',
        hours:      'hours ago',
        day:        'a day ago',
        days:       'days ago'
    }

    // Function to filter tweet results. 
    filter:         false

## Advanced options

### Callback

You can specify a callback function. The function gets the tweets collection as first parameter and the number of tweets displayed as the second. 
This is an example where we handle the case where no tweets are found and a loading notice that shows before the first tweets are loaded.

    $('#tweets').tweetMachine('#test',	{},
        function(tweets, tweetsDisplayed) {
		    //Remove the loading notice
            $('#twitter-placeholder').fadeOut();
            if(tweetsDisplayed <= 0)
            {
			    //Show no tweets found notice
                $('#sf-twitter-feed').html('<p class="no-tweets-notice">No tweets found</p>')
            }
        }
    );


### Filtering tweets

You can filter tweets by providing a function that returns true if a tweet is to be shown and false if it isn't. Here's a silly foul language filter:

    var swearList = ["frack", "darn", "gosh", "shucks", "shoot", "dang", "fudge", "mother trucker"];

    $('#tweets').tweetMachine( '#puppy', {
        filter: function(tweet) {
            var swear, i, len;
            // Loop through the swears in the list
            for ( i = 0, len = swearList.length; i < len; i++ ) {
                swear = swearList[i];
                // If the tweet's text has the swear in it
                if (tweet.text.indexOf(swear) !== -1) {
                    // Don't show it
                    return false;
                }
            }
            // If it hasn't had any swears, show it
            return true;
        }
    });

## Changelog

### `v0.2.1a`

- Changed file paths so the script doesn't have to be installed in the root

### `v0.2a`

- Added callback (thanks [pelmered](https://github.com/pelmered))

### `v0.1a`

- Initial commit
