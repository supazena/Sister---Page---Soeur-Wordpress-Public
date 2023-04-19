<? php

// ShortCode Pages soeur
// Sister Pages ShortCode
/*
Utilisation après implémentation:

\[sister_pages\]
\[sister_pages exclude="8,9"\] //on peut exclure des pages en indiquant les ID séparés par des virgules comme ici avec 8 et 9
*/

add\_shortcode( 'sister\_pages', 'sister\_pages\_get\_sister\_pages' );
function sister\_pages\_get\_sister\_pages($atts) {

// normalize attribute keys, lowercase

$atts = array\_change\_key\_case( (array) $atts, CASE\_LOWER );

//Current Post
$post = get\_post(get\_the_ID());

//Excludes
$posts\_to\_exclude = array();

// Post passed in parameters
if(isset($atts\['exclude'\])){
$posts\_to\_exclude = array_map('intval', explode(",",$atts\['exclude'\]));
}
array\_push($posts\_to_exclude, $post->ID);// Current Post

//Get Sister Pages

$pages = get_pages(array(
'child\_of' => $post->post\_parent,
'exclude' => $posts\_to\_exclude,
'parent' => $post->post_parent
));

//var_dump($pages);
//If Sister Page
if (count($pages)>0){
// personnaliser le CSS de l'afficgage ci-besoin :

$return = "&lt;aside style=\\"background:#efefef; padding: 40px; font-size:18px;margin-top:40px\\"&gt;&lt;p style=\\"color:#423171; font-weight:600; font-size:24px\\"&gt;Ces pages peuvent vous intérresser&lt;/p&gt;
&lt;nav class=\\"pagesoeur\\" id=\\"pagesoeurs\\"&gt;&lt;ul&gt;";
foreach ($pages as $page){
$return .= '&lt;li&gt;&lt;a href="'.get\_permalink($
KaTeX parse error: Expected 'EOF', got '&' at position 12: return .= '&̲lt;li><a …
page).'">'.$page->post_title."&lt;/a&gt;&lt;/li&gt;";
}
$return .= "&lt;ul&gt;&lt;/nav&gt;&lt;/aside&gt;";
}else{
$return = "";
}
return $return;
}

?>
