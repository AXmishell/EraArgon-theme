<?php
// 导航菜单 Walker 类：顶栏菜单、侧栏菜单、作者链接、友情链接
						class toolbarMenuWalker extends Walker_Nav_Menu{
							public function start_lvl( &$output, $depth = 0, $args = array() ) {
								$indent = str_repeat("\t", $depth);
								$output .= "\n$indent<div class=\"dropdown-menu\">\n";
							}
							public function end_lvl( &$output, $depth = 0, $args = array() ) {
								$indent = str_repeat("\t", $depth);
								$output .= "\n$indent</div>\n";
							}
							public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
								if ($depth == 0){
									if ($args -> walker -> has_children == 1){
										$output .= "\n
										<li class='nav-item dropdown'>
											<a href='" . $object -> url . "' class='nav-link' data-toggle='dropdown' no-pjax onclick='return false;' title='" . $object -> description . "'>
										  		<i class='ni ni-book-bookmark d-lg-none'></i>
												<span class='nav-link-inner--text'>" . $object -> title . "</span>
										  </a>";
									}else{
										$output .= "\n
										<li class='nav-item'>
											<a href='" . $object -> url . "' class='nav-link' target='" . $object -> target . "' title='" . $object -> description . "'>
										  		<i class='ni ni-book-bookmark d-lg-none'></i>
												<span class='nav-link-inner--text'>" . $object -> title . "</span>
										  </a>";
									}
								}else if ($depth == 1){
									$output .= "<a href='" . $object -> url . "' class='dropdown-item' target='" . $object -> target . "' title='" . $object -> description . "'>" . $object -> title . "</a>";
								}
							}
							public function end_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
								if ($depth == 0){
									$output .= "\n</li>";
								}
							}
						}

				class leftbarMenuWalker extends Walker_Nav_Menu{
					public function start_lvl( &$output, $depth = 0, $args = array() ) {
						$indent = str_repeat("\t", $depth);
						$output .= "\n$indent<ul class=\"leftbar-menu-item leftbar-menu-subitem shadow-sm\">\n";
					}
					public function end_lvl( &$output, $depth = 0, $args = array() ) {
						$indent = str_repeat("\t", $depth);
						$output .= "\n$indent</ul>\n";
					}
					public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
						$output .= "\n
						<li class='leftbar-menu-item" . ( $args -> walker -> has_children == 1 ? " leftbar-menu-item-haschildren" : "" ) . ( $object -> current == 1 ? " current" : "" ) . "'>
							<a href='" . $object -> url . "'" . ( $args -> walker -> has_children == 1 ? " no-pjax onclick='return false;'" : "" ) . " target='" . $object -> target . "'>". $object -> title . "</a>";
					}
					public function end_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
						//if ($depth == 0){
							$output .= "</li>";
						//}
					}
				}

								class leftbarAuthorLinksWalker extends Walker_Nav_Menu{
									public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
										if ($depth == 0){
											$output .= "\n
											<div class='site-author-links-item'>
												<a href='" . $object -> url . "' rel='noopener' target='_blank'>". $object -> title . "</a>";
										}
									}
									public function end_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
										if ($depth == 0){
											$output .= "</div>";
										}
									}
								}

								class leftbarFriendLinksWalker extends Walker_Nav_Menu{
									public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
										if ($depth == 0){
											$output .= "\n
											<li class='site-friend-links-item'>
												<a href='" . $object -> url . "' rel='noopener' target='_blank'>". $object -> title . "</a>";
										}
									}
									public function end_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
										if ($depth == 0){
											$output .= "</li>";
										}
									}
								}
