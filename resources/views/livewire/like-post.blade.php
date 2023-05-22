
     <!--suppress ALL -->
     <div>
        @empty($liked)
              <button class="btn"><a class="fa fa-heart" style="color: palevioletred" wire:click="like"/>.</button>

        @else
             <button><a class="fa fa-heart" style="color: grey" wire:click="like"/>.</button>
        @endempty
    </div>

