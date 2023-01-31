<div class="container">
    <br />    
        <div class="row">
            @foreach ($offers as $offer)
            <div class="col-3">
                <div class="card" style="margin: 20px;">
                    <div class="card-header">Offer id: {{ $offer->id }}</div>
                    <div class="card-body">
                      <p>Nazwa: {{ $offer->item_name }}</p>
                      <p>Kategoria: {{ $offer->category }}</p>
                      <img src="{{ $offer->pictures }}" width ="40%" height="40%" alt="no image found" />
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div class="row" style="float: right;" >{{ $offers->links() }}</div>
</div>