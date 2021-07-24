<form id="item-{{$id}}" action="{{$url}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="delete" />
</form>