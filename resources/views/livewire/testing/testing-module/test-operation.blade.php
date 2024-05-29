<div>
    <x-slot name="header">Test Operations</x-slot>

    <!-- Top Controls ------------------------------------------------------------------------------------------------->

    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>

        @forelse ($list as $row)
{{--            {{dd($list)}}--}}
            <div class="w-full flex justify-center">
                <div class="w-3/4 bg-gray-100 rounded-xl mt-10">
                    <div class="flex justify-between p-5">
                        <a href="{{route('operation.reply',[$row->id])}}">
                            <div class="text-2xl font-mono font-bold">{{ $row->actions->vname ?: " "}} - {{ $row->vname }}</div>
                        </a>
                        <div class="w-1/4 flex justify-between">
                            <div class="text-gray-500 text-sm font-bold">{{ $row->vdate }}</div>
                            <div class="font-mono">By : <span class="font-mono font-bold"> {{ $row->user->name }}</span></div>
                            <div>
                                <button wire:click="edit({{ $row->id }})"
                                        class="">
                                    <x-icons.icon :icon="'pencil'" class="h-4 w-auto block text-blue-500 hover:scale-110"/>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex px-5 gap-x-4">
                        <div class=" w-96 h-60 p-3 rounded bg-white overflow-y-auto">
                            <a href="{{route('operation.reply',[$row->id])}}">
                            <div class="grid grid-cols-1 gap-2 justify-evenly ">
                                @foreach($images as $img)
                                    @if($img->vname==$row->vname)
                                        <img src="{{ URL(\Illuminate\Support\Facades\Storage::url($img->image)) }}" alt="" class="w-96 h-auto rounded-xl ">
                                    @endif
                                @endforeach
                            </div>
                            </a>
                        </div>

                        <div class="w-3/4 h-60 bg-gray-600 text-white rounded p-4">
                            <a href="{{route('operation.reply',[$row->id])}}">
                            <div class="w-full h-60 flex-col break-words overflow-y-auto">{!! $row->body !!}</div>
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-between p-5">
                        <div><span class="font-mono">Assignee  :  </span><span class="font-mono font-semibold">{{ \Aaran\Testing\Models\TestOperation::assign($row->assignee) }}</span></div>
                        <div class="flex-col">
                            <div class="text-center rounded {{ \App\Enums\Status::tryFrom($row->status)->getStyle() }}">{{ \App\Enums\Status::tryFrom($row->status)->getName() }}</div>
                            <div class="flex">
                                <div class="text-gray-500 text-sm font-bold">{{ \App\Helper\ConvertTo::dateTime($row->updated_at)}} </div>
                                <div class="w-4 h-4 {{\App\Enums\Active::tryFrom($row->active_id)->getName()}}"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
{{--            <div class="border border-gray-400 w-full lg:flex h-44">--}}

{{--                <!------ Id and Status -------------------------------------------------------------------------------->--}}
{{--                <div class="w-1/12 lg:flex-col">--}}


{{--                    <div class="h-3/4 border border-gray-400 ">--}}
{{--                        <a href="{{route('operation.reply',[$row->id])}}"--}}
{{--                           class="cursor-pointer text-2xl h-3/4 lg:flex items-center justify-center ">--}}
{{--                            {{ $row->id}}--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div--}}
{{--                        class="lg:flex items-center justify-center h-1/4 border border-gray-400  {{ \App\Enums\Status::tryFrom($row->status)->getStyle() }}">--}}
{{--                        {{ \App\Enums\Status::tryFrom($row->status)->getName() }}--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!------ content -------------------------------------------------------------------------------------->--}}

{{--                <div class="flex-col w-full p-5">--}}

{{--                    <div class="h-1/4 lg:flex justify-between ">--}}
{{--                        <div class="w-full">--}}
{{--                            <a href="{{route('operation.reply',[$row->id])}}"--}}
{{--                               class="cursor-pointer w-full text-2xl text-left px-2 hover:underline underline-offset-8">--}}

{{--                                {{ $row->actions->vname ?: " "}}&nbsp;&nbsp;-&nbsp;&nbsp;--}}
{{--                                {{ $row->vname }}--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="w-full">--}}
{{--                                {{ $row->vdate }}--}}
{{--                        </div>--}}

{{--                        <div class="w-full flex gap-3 items-end justify-end my-auto ">--}}

{{--                            <a class="cursor-pointer">By : {{ $row->user->name }}</a>--}}

{{--                            <button wire:click="edit({{ $row->id }})"--}}
{{--                                    class=" px-1.5 rounded-md  mr-3 inline-flex gap-3">--}}
{{--                                <x-icons.icon :icon="'pencil'" class="h-5 w-auto block px-1.5 text-blue-500 hover:scale-110"/>--}}

{{--                            </button>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="h-2/4 p-3 ml-5 overflow-hidden w-3/4 text-gray-600 ">--}}
{{--                        {!! $row->body !!}--}}
{{--                    </div>--}}

{{--                    <div class="h-1/4 ">--}}
{{--                        <div class="flex flex-row justify-between ">--}}

{{--                            <div class="px-3 flex flex-row justify-between ">--}}

{{--                                <div class="flex flex-row gap-2 mt-2 ">--}}
{{--                                    <span class=" text-sm py-0.5 text-gray-500">Assignee :</span>--}}
{{--                                    <span--}}
{{--                                        class=" text-md text-gray-600">{{ \Aaran\Testing\Models\TestOperation::assign($row->assignee) }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="px-3 py-1 flex flex-row gap-3 items-center">--}}
{{--                                {{ \App\Helper\ConvertTo::dateTime($row->updated_at)}}--}}
{{--                                <div--}}
{{--                                    class="text-center flex items-center w-4 h-4 mr-2 text-sm rounded-full {{\App\Enums\Active::tryFrom($row->active_id)->getStyle()}}">--}}
{{--                                    &nbsp;--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


        @empty
            <div class="flex justify-center items-center space-x-2">
                <x-table.empty/>
            </div>
        @endforelse

        <!-- Create Record ---------------------------------------------------------------------------------------->


        <x-forms.create-new :id="$vid">
            <div class="flex space-x-5">
                <div class="">
                    <div class="xl:flex flex-row gap-3 py-3">
                    <label class="w-[10rem] text-zinc-500 tracking-wide ">Action</label>
                    <label class="text-lg font-bold">{{Aaran\Testing\Models\TestOperation::action($actions_id)}}</label></div>
{{--                    <x-input.model-select wire:model="actions_id" :label="'action'">--}}
{{--                        <option class="text-gray-400"> choose ..</option>--}}
{{--                        @foreach($actions as $action)--}}
{{--                            <option value="{{$action->id}}">{{$action->vname}}</option>--}}
{{--                        @endforeach--}}
{{--                    </x-input.model-select>--}}


                    <x-input.model-date wire:model="vdate" :label="'Date'"/>
                    <x-input.model-text wire:model="vname" :label="'Title'"/>

                    <div class="">
                        <x-input.rich-text wire:model="body" :placeholder="''" />
                    </div>

                </div>



                <div>
                    <x-input.model-select wire:model="assignee" :label="'Assign To'">
                        <option class="text-gray-400"> choose ..</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-input.model-select>

                    @admin
                    <x-input.model-text wire:model="verified" :label="'Verified'"/>
                    @endadmin

                    <!-- Image  ---------------------------------------------------------------------------------------->

                    <label class="w-[10rem] text-zinc-500 tracking-wide py-2"></label>

                    <div class="grid grid-cols-2 flex-shrink-0 h-80 w-80 mr-4">
                        Photo Preview:
                        @if($photos)
                            @foreach($photos as $index => $image)
                                <div class="flex gap-1">
                                    <img class="max-h-32 w-auto"
                                         src="{{ $image->temporaryUrl()}}"
                                         alt="{{$image}}">
                                </div>
                            @endforeach
                        @endif
                        @if($old_photos)
                            @foreach($old_photos as $index => $image)
                                <div class="flex gap-1">
                                    <img class="max-h-32 w-auto"
                                         src="{{url(\Illuminate\Support\Facades\Storage::url($image)) }}"
                                         alt="{{$image}}">
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div>
                        <input type="file" wire:model="photos" multiple>
                        <button wire:click.prevent="save_image"></button>
                    </div>
                </div>

            </div>

        </x-forms.create-new>
    </x-forms.m-panel>

    <script>
    </script>
</div>

