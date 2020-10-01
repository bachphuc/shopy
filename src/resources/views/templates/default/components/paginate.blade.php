@if(isset($items) && $items && method_exists($items, 'total'))
<div class="paginate text-center">
    <span class="paginate-total">
        @lang('elements::lang.paginate_text', ['length' => $items->count(), 'total' => $items->total(), 'type' => isset($item_type) ? $item_type : trans('lang.object_s')])
    </span>
    <span class="pagination__option">
        @if(isset($params) && !empty($params))
        {{ $items->appends($params)->links() }}
        @else
        {{ $items->links() }}
        @endif
    </span>
</div>
@endif