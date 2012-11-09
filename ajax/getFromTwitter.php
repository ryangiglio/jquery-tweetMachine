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

    // NOTE: These keys are provided so the sample.html file can run. Don't use
    // them in a production environment because the rate limit will be lumped
    // in with everyone else testing the plugin
    $consumerKey        = 'PhzyE5PHeU2kA0O0PJ6tRQ';
    $consumerSecret     = 'GoTC9U4g4kt1Y04U5QMHQOx1FG00cmvEgfJKZpAHk';
    $accessToken        = '80357329-yagx966GbLPSAbYlzoAtj4BpnO3YofGZFLrqG5ZeQ';
    $accessTokenSecret  = 'd3pLxnSX0C72474pnASrtoXLzhQ5R3xlZ5nDyz1H0';

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
