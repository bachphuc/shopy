<div class="{{isset($class) ? $class : 'col-lg-3 col-md-4 col-sm-6'}}">
    <div class="mb-5 shadow-lg rounded">
        <div>
            <a href="@__href">
                <img class="rounded-top" src="@__img" alt="@__title" />
            </a>
        </div>
        <div class="mt-2 p-4 ">
            <div>
                <a href="@__href">@__title</a>
            </div>
            <div class="mt-2">@__g('display_price')</div>
        </div>
        
    </div>
</div>