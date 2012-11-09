<?
    /*========================================================================
     * PHP Backend for jQuery TweetMachine. This allows you to interact with 
     * various endpoints of the Twitter API using the keys and access tokens 
     * from a Twitter app that you created.
     ========================================================================*/

    /*
     * First, include the TwitterOAuth library. v0.2.0-beta2 has been included 
     * but you can always download the latest version from:
     * https://github.com/abraham/twitteroauth
     */
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/twitteroauth/twitteroauth.php';

    /*  BEGIN SETUP ============================================================
    
    You can make API calls without authenticating a user account by creating 
    an app instead. Then you can create an access token and access token 
    secret in the app's settings.

    To do this:
    1) Go to https://dev.twitter.com/apps and create a new application
    2) Choose your new app from the list
    3) Under the Details tab you can see your Consumer key and Consumer 
    secret. Copy these into $consumerKey and $consumerSecret
    4) At the bottom of the page, click "Create my access token" under the 
    "Your access token" heading. This will generate and Access token and 
    Access token secret. Copy these into $accessToken and $accessTokenSecret */

    $consumerKey        = 'PMCmXpGvCM7reYJuRiwwXA';
    $consumerSecret     = 'wpSf2tFQRDoMrnKmObLy8fe7Iah8cqqvFor08Ig4';
    $accessToken        = '621171960-tC6OGKXvXomv9HBaFEaL4fhEJ1gGfhNOROEf6izL';
    $accessTokenSecret  = 'OSMH6Ou36q1hJq8h1HlKe25NsC3MD5wxcbWltiZ0';

    /* END SETUP ==========================================================*/
    
    /*
     * Get the endpoint that you'd like to access.
     */
    $endpoint = $_GET['endpoint'];

    /*
     * Get the query parameters passed by Javascript. This is passed as an 
     * array so we don't have to do any processing.
     */
    $queryParams = $_GET['queryParams'];

    /*
     * Establish an authenticated connection to Twitter using TwitterOAuth and 
     * the keys you've provided above.
     */
    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

    /*
     * Get the tweets!
     */
    $tweets = $connection->get($endpoint, $queryParams);

    /*
     * Print out the tweets in a JSON array.
     */
    echo json_encode($tweets->statuses);
