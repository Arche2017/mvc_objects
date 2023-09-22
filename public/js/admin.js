var arr=document.getElementsByTagName('tr');
for (var i = 0; i < arr.length; i++) {
    var parent_id=arr[i].getAttribute('parent_id');
    if(parent_id>0) arr[i].style.display = "none";
    //вычисляем вложенные объекты
    let id = arr[i].getAttribute('id').split('_')[1];
    count=countChilds(arr[i],id);
    //console.log(count);
    if(count>0) 
        {
            arr[i].childNodes[1].innerText = '+';
            arr[i].childNodes[1].classList.add('plus-minus');
        }
        //показ вложенных объектов при нажатии на плюс
    arr[i].childNodes[1].onclick = function() {
        let object_row=this.parentNode;
        let id = object_row.getAttribute('id').split('_')[1];
        let hidden_children=object_row.getAttribute('hidden_children');
        if(hidden_children=='true')
        {
            object_row.setAttribute('hidden_children','false')
            show_objects(object_row,id);
            object_row.childNodes[1].textContent = '-';
        }
        else 
        {
            object_row.setAttribute('hidden_children','true')
            hide_objects(object_row,id);
            object_row.childNodes[1].textContent = '+';
        }
        
    };
    //показ меню
    arr[i].childNodes[2].onclick = function() {
        let object_row=this.parentNode;
        let id = object_row.getAttribute('id').split('_')[1];
        let menu= document.getElementById('menu');
        document.getElementById('add_object_form').querySelector('.parent_id').value = id;
        document.getElementById('delete_object_form').querySelector('.object_id').value = id;
        toggle(menu);
    } 
}
//убрать меню
document.getElementById('menu').childNodes[7].onclick = function() {
    this.parentNode.style.display = "none";
}
//показ формы добавления объекта
document.getElementById('menu').childNodes[1].onclick = function() {
    let form= document.getElementById('add_object_form');
    toggle(form);
} 
//показ формы удаления объекта
document.getElementById('menu').childNodes[3].onclick = function() {
    let form= document.getElementById('delete_object_form');
    toggle(form);
} 
//показать вложенные объекты
function show_objects(elem,id)
{
    let next = elem.nextElementSibling;
    if(!next) return false;
    let parent_id = next.getAttribute('parent_id');
    if(parent_id==id) 
    {
        next.style.display = 'table-row';
        show_objects(next,id);
    }
    show_objects(next,id);
}
//спрятать вложенные объекты
function hide_objects(elem,id)
{
    let next = elem.nextElementSibling;
    if(!next) return false;
    let parent_id = next.getAttribute('parent_id');
    if(parent_id==id) 
    {
        next.style.display = 'none';
        hide_objects(next,id);
    }
    hide_objects(next,id);
}
//посчитать вложенные объекты
function countChilds(elem,id,count=0)
{
    let next = elem.nextElementSibling;
    if(!next) return count;
    let parent_id = next.getAttribute('parent_id');
    if(parent_id==id) 
    {
        count++;
        countChilds(next,id,count);      
    }
    return countChilds(next,id,count);
    //countChilds(next,id,count);
}
//показать/скрыть элемент страницы
function toggle(elem)
{
    if (elem.style.display === "none") {
        elem.style.display = "block";
    } else {
        elem.style.display = "none";
    }
}