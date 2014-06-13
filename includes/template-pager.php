				<?php //Pagination/Pager
				if (function_exists('uu2014dev_page_navi')):
					uu2014dev_page_navi();
				else: ?>

					<nav class="wp-prev-next">
						<ul class="clearfix">
							<li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "scaffolding")) ?></li>
							<li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "scaffolding")) ?></li>
						</ul>
					</nav>

				<?php endif; ?>