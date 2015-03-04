<?php

// Extracts the Domain Name for a URL for presentation purposes
if (!function_exists('extract_domain_name'))
{
function extract_domain_name($url) {
   $host = parse_url($url, PHP_URL_HOST);
   $host = preg_replace("/^www\./", "", $host);
   return $host;
  }
}

function get_syndication_links() {
<<<<<<< HEAD
   $options = get_option ('syndication_content_options');
   $syn = get_post_meta(get_the_ID(), 'syndication_urls', true ); 
   $mf2 = get_post_meta(get_the_ID(), 'mf2_syndication', true );
   $meta = $syn . $mf2;
   if (empty($meta))
	{
	   $synlinks = '';
 	}
   else{
	   $urls = explode("\n", $meta);
     // Allow URLs to be added by other plugins
     $urls = apply_filters('syn_add_links', $urls);
	   $strings = get_syn_network_strings();
	   $synlinks = '<span class="relsyn social-icon"><ul>' . $options['text_before']; 
           foreach( $urls as $url){
			    $domain = extract_domain_name($url);
			    if (array_key_exists($domain, $strings))
				{ 
					$name = $strings[$domain];
				}
			    else {
					$name = $domain;
				 }
              		    $synlinks .=  '<li><a title="' . $name . '" class="u-syndication" href="' . esc_url($url) . '" rel="syndication">'; 
             		    if ($options['just_icons'] == "1" )
                 		{ 
                   		  $synlinks .= $name;
                 		}
           		    $synlinks .= '</a></li>';
                         }
          $synlinks .= '</ul></span>';
       }
   return $synlinks;
=======
    $options = get_option('syndication_content_options');
    $urls = explode("\n", get_post_meta(get_the_ID(), 'syndication_urls', true));
    // Allow URLs to be added by other plugins
    $urls = apply_filters('syn_add_links', $urls);
    if (!empty($urls)) {
        $strings = get_syn_network_strings();
        $synlinks = '<span class="relsyn social-icon"><ul>' . $options['text_before'];
        foreach ($urls as $url) {
            $domain = extract_domain_name($url);
            if (array_key_exists($domain, $strings))
            {
                $name = $strings[$domain];
            }
            else {
                $name = $domain;
            }
            $synlinks .=  '<li><a title="' . $name . '" class="u-syndication" href="' . esc_url($url) . '" rel="syndication">'; 
            if ($options['just_icons'] == "1")
            {
                $synlinks .= $name;
            }
            $synlinks .= '</a></li>';
        }
        $synlinks .= '</ul></span>';
    }
    return (empty($synlinks)) ? '' : $synlinks;
>>>>>>> 0f2faeaf90549f989788188115017736f8f69374
}

function syndication_links_before($meta = "" ) {
   return get_syndication_links() . $meta;
   }

function syndication_links_after($meta = "" ) {
   return $meta . get_syndication_links();
   }

$option = get_option('syndication_content_options');
if($option['the_content']=="0"){
         add_filter( 'the_content', 'syndication_links_after', 20 );
   }

?>
