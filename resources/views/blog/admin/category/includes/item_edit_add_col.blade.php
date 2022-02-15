@php
    @php /** @var \App\Models\BlogCategory $item */ @endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" slass="btn btn-primari">Сохранить</button>
            </div>
        </div>
    </div>
</div><br>
@if($item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>ID: {{ $item->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="titie">Сщздано</label>
                        <input type="text" value="{{ $item->created_at }}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="titie">Изменино</label>
                        <input type="text" value="{{ $item->updated_at }}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="titie">Удалено</label>
                        <input type="text" value="{{ $item->updated_at }}" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
@endif

