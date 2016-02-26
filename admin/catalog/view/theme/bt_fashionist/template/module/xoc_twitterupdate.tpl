<?php global $config;?>
<div class="box-tweeter column col-xs-12 col-sm-4 not-animated" data-animate="fadeInLeft" data-delay="500">
  <div class="tweeter-heading"><h3><?php echo $heading_title; ?></h3></div>
  <div class="tweeter-content">
      <?php 
		require_once( DIR_TEMPLATE.$config->get('config_template')."/template/twitteroauth/twitteroauth.php" );
		$twitter_un = $username;
		$num_tweets = $limit;
		$consumerkey = $consumer_key;
		$consumersecret = $consumer_secret;
		$accesstoken = $access_token;
		$accesstokensecret = $access_token_secret;
		$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_un."&count=".$num_tweets);?>
		<ul id="twitter-list">
			<?php if(!isset($tweets->error)&& !isset($tweets->errors)) {?>
			<?php if(isset($tweets)){ ?>
			<?php foreach($tweets as $tweet){ ?>
			<li class="status-item">
				<?php if($show_profile){?>
				<div class="tweet-profile">
					<a title="@<?php echo $twitter_un; ?>" href="https://twitter.com/<?php echo $twitter_un; ?>"><img alt="<?php echo $twitter_un; ?>" src="<?php echo $tweet->user->profile_image_url;?>" /></a>
				</div>
				<?php } ?>
				<div class="tweet-content">
					<span class="tweet-text"><span>@<?php echo $tweet->user->name; ?></span> <?php echo utf8_substr(strip_tags(html_entity_decode($tweet->text, ENT_QUOTES, 'UTF-8')), 0, 200);?></span>
					<?php if($show_time){?>
					<div class="date-time"><a href="<?php echo 'http://twitter.com/'.$tweet->user->screen_name.'/statuses/'.$tweet->id; ?>"><?php echo $tweet->created_at; ?></a></div>
					<?php } ?>
				</div>
			</li>
			<?php } } } ?>
		</ul>
		<?php if($show_follow){?>
		<a href="https://twitter.com/<?php echo $twitter_un; ?>" class="twitter-follow-button" data-show-count="false">Follow @<?php echo $twitter_un; ?></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<?php } ?>
  </div>
</div>
<style type="text/css"><!--
.tweet-content {
text-align: justify;
}
.tweet-profile {
float: left;
margin-right: 10px;
}
ul#twitter-list{
list-style: none;
padding-left: 0px;
}
#twitter-list li {
margin: 15px 0;
}
//--></style>
