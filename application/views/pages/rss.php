<?php echo "<?xml version='1.0' encoding='UTF-8' ?>"; ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
<channel>
<title><?php echo $this->option_model->get_value('appname'); ?></title>
 
<link><?php echo base_url(); ?></link>
<description><?php echo $this->option_model->get_value('appdescription'); ?></description>
<dc:language>en-en</dc:language>
<dc:creator></dc:creator>
 
<dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
<admin:generatorAgent rdf:resource="http://www.codeigniter.com/" />

<?php foreach($posts->result() as $post): ?> 
   <item> 
      <title><?php echo xml_convert($post->post_subject); ?></title>
      <?php if ($this->option_model->get_value('applayout') == 1) { ?>  
      <link><?php echo base_url(); ?>stories/r/<?php echo $post->post_slug; ?></link>
      <guid><?php echo base_url(); ?>stories/r/<?php echo $post->post_slug; ?></guid>
      <?php } else { ?>
      <link><?php echo base_url(); ?>stories/article/<?php echo $post->post_slug; ?></link>
      <guid><?php echo base_url(); ?>stories/article/<?php echo $post->post_slug; ?></guid>
      <?php } ?>      
      <description><![CDATA[ <?php echo character_limiter($post->post_text, 200); ?> ]]></description>
      <dc:creator><?php echo $post->post_domain; ?></dc:creator>
      <category><?php echo $post->category_name; ?></category>
      <?php echo "<pubDate>".date(DATE_RSS, strtotime($post->post_date))."</pubDate>"; ?>
    </item>     
<?php endforeach; ?>
 
</channel>
</rss>