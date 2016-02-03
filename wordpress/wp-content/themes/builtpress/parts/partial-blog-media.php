<?php

switch ( get_post_format() ):
	case 'gallery':
		$blog_gallery = get_post_meta(get_the_ID(), '_st_blog_format_gallery', TRUE);
		if ( is_array($blog_gallery) ) {
			builtpress_slider($blog_gallery, 'builtpress-large');
		}
	break;
	case 'video':
		$blog_video = get_post_meta(get_the_ID(), '_st_blog_format_video', TRUE);
		if ( !empty($blog_video) ) {
			echo '<div class="post-thumb">';
			if ( wp_oembed_get($blog_video) ) {
				echo wp_oembed_get($blog_video);
			}
			else {
				echo htmlspecialchars_decode( esc_textarea( $blog_video ), ENT_QUOTES );
			}
			echo '</div>';
		}
	break;
	case 'audio':
		$blog_audio = get_post_meta(get_the_ID(), '_st_blog_format_audio', TRUE);
		if ( !empty($blog_audio) ) {
			echo '<div class="post-thumb">';
			if ( wp_oembed_get($blog_audio) ) {
				echo wp_oembed_get($blog_audio);
			}
			else {
				echo htmlspecialchars_decode( esc_textarea( $blog_audio ), ENT_QUOTES );
			}
			echo '</div>';
		}
	break;
	case 'quote':
		$blog_quote = get_post_meta(get_the_ID(), '_st_blog_format_quote', TRUE);
		$blog_quote_author = get_post_meta(get_the_ID(), '_st_blog_format_quote_author', TRUE);
		if ( !empty($blog_quote) ) {
			printf(
				'<div class="post-quote">
					<blockquote>
						<p>%s</p>
						<div><cite>%s</cite></div>
					</blockquote>
				</div>',
				esc_attr( $blog_quote ),
				esc_html( $blog_quote_author )
				);
		}
	break;
	case 'standar':
	default:
		if ( has_post_thumbnail() ) {
			$imageLink = wp_get_attachment_image_src(get_post_thumbnail_id(), 'builtpress-large');
			$imageLink = $imageLink[0];
			$imageURL = get_the_post_thumbnail(get_the_ID(), 'builtpress-large');
			
			$prettyPhoto = is_single() ? ' rel="prettyPhoto"' : '';
			
			printf(
				'<div class="post-thumb">
					<a href="%s" title="%s"%s>%s</a>
				</div>',
				is_single() ? $imageLink : get_permalink(),
				the_title_attribute('echo=0'),
				$prettyPhoto,
				$imageURL
				);
		}
	break;
endswitch;