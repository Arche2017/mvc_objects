var arr=document.getElementsByTagName('tr');
for (var i = 0; i < arr.length; i++) {
    var parent_id=arr[i].getAttribute('parent_id');
    if(parent_id>0) arr[i].style.display = "none";
    arr[i].onclick = function() {
        let id = this.getAttribute('id').split('_')[1];
        let hidden_children=this.getAttribute('hidden_children');
        if(hidden_children=='true')
        {
            this.setAttribute('hidden_children','false')
            show_objects(this,id);
        }
        else 
        {
            this.setAttribute('hidden_children','true')
            hide_objects(this,id);
        }
    };
}
function show_objects(elem,id)
{
    let next = elem.nextElementSibling;
    let parent_id = next.getAttribute('parent_id');
    if(parent_id==id) 
    {
        next.style.display = 'table-row';
        show_objects(next,id);
    }
    show_objects(next,id);
}
function hide_objects(elem,id)
{
    let next = elem.nextElementSibling;
    let parent_id = next.getAttribute('parent_id');
    if(parent_id==id) 
    {
        next.style.display = 'none';
        hide_objects(next,id);
    }
    hide_objects(next,id);
}