<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content section-bgcolor">
        <div class="modal-header b-0">
            <h3 class="modal-title title-font title-color fw-bold" id="exampleModalLabel">Eliminare "{{$event->event_title}}"?</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="fs-5 fw-bold text-font text-color">Sei sicuro di voler eliminare definitavamente l'evento {{$event->event_title}}? </p>
            <span class="text-font text-color">Una volta eliminato l'evento non si potrà recuperare</span>
        </div>
        <div class="modal-footer">
            <button type="button" class="button-font btn-close-modal text-color" data-bs-dismiss="modal">Chiudi</button>
            <form action="{{route('admin.events.destroy', ['event'=> $event->id])}}" method="post">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="button-bgcolor button-font btn-star-show-event-profile">Elimina</button>
            </form>
        </div>
        </div>
    </div>
</div>