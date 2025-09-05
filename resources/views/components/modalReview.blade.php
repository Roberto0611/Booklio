<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Escribir reseña
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('books.reviews.store', $book->id) }}" method="post" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        {{-- Rating (estrellas 1-5) --}}
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Calificación:</label>
                        <style>
                            /* Scoped rating styles: use SVG fill so Tailwind text-color doesn't override; hover fills hovered star and all lower-value (visual left) stars */
                            .rating label svg { fill: #d1d5db; transition: transform .12s ease, fill .12s ease; }
                            /* checked state: the checked star and all "after" siblings in the DOM (which are lower values) */
                            .rating input:checked + label svg,
                            .rating input:checked + label ~ label svg {
                                fill: #f59e0b; /* yellow-400 */
                                transform: scale(1.05);
                            }
                            /* hover state: hovered label and its following siblings in DOM (lower values) */
                            .rating label:hover svg,
                            .rating label:hover ~ label svg {
                                fill: #f59e0b;
                                transform: scale(1.05);
                            }
                            .rating label { display: inline-flex; }
                        </style>

                        <div role="radiogroup" aria-label="Calificación" class="rating flex flex-row-reverse items-center gap-1 mb-3">
                            {{-- Tailwind-style rating: render inputs 5..1 and use flex-row-reverse so visual order is 1..5 --}}
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}" class="sr-only peer" {{ $i == 5 ? 'checked' : '' }} aria-label="{{ $i }} estrellas">
                                <label for="rating{{ $i }}" title="{{ $i }} estrellas" class="cursor-pointer text-gray-300 hover:text-yellow-400 transition peer-checked:text-yellow-400 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-yellow-300 rounded">
                                    {{-- Heroicon solid star (Tailwind-friendly) --}}
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.447a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.488 2.677c-.785.57-1.84-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.526 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                </label>
                            @endfor
                        </div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción:</label>
                            <textarea id="review" name="review" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aqui tu reseña: "></textarea>
                    </div>
                </div>
                {{-- Separación entre textarea y botón --}}
                <div class="mt-4">
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Enviar reseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 