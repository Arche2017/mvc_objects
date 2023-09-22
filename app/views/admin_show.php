<div id="content">
	<h2>Таблица объектов</h2>
	<a href="/admin/exit">Выход</a>
	<table id="objects_table">
	  	<?php
	  	echo $data;
		?>
	</table>
	<ul id="menu" style="display:none;">
		<li>Добавить внутренний объект</li>
		<li>Удалить текущий объект</a></li>
		<li>Посмотреть описание</li>
		<li>Закрыть</li>	
	</ul>
	<form id="add_object_form" method="post" action="/objects/insert" style="display:none;">
		<h3>Добавить объект</h3>
		<input type="hidden" class="parent_id" name="parent_id" value=""><br/>
		<label>Название</label><br/>
		<input type="text" name="title" id="title"><br/>
		<label>Описание</label><br/>
		<textarea name="text" id="text"></textarea><br/>
		<button>Добавить</button>
	</form>
	<form id="delete_object_form" method="post" action="/objects/delete" style="display:none;">
		<input type="hidden" name="object_id" class="object_id" value="">
		<p>Вы точно хотите удалить данный объект и все вложенные объекты?</p>
		<button>Удалить</button>
	</form>
</div>
<script src="/public/js/admin.js"></script>

