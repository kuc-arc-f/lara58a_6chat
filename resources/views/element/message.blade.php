<div class="btn-group message_menu_wrap mb-2" data-toggle="tooltip" title="通知リスト表示できます">
	<button type="button" class="btn btn-info dropdown-toggle"
	data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?= count($messages) ?>
		<?php //var_dump( count($messages) ); ?>
		<i class="far fa-bell"></i>
	</button>
	<div class="dropdown-menu">
		@foreach ($messages as $message )
		<div class="dropdown-item pl-4 pr-4">
			<a href="/messages/<?= $message->id ?>">
				<span class="notify_menu_text mb-0">
					{{$message->name}}<br />
					{{$message->title}}<br />
					{{$message->date_str}}<br />
				</span>
			</a>
			<div class="dropdown-divider notify_menu_line mt-0 mb-0"></div>
		</div>		
		@endforeach
	</div><!-- /.dropdown-menu -->
</div><!-- /.btn-group -->
