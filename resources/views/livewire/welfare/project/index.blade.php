<div>
    <x-slot name="header">Project</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Header --------------------------------------------------------------------------------------------------->
        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.header-serial wire:click.prevent="sortBy('vname')"/>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Project</x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Description</x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Segment</x-table.header-text>
                <x-table.header-action/>
            </x-slot>

            <!-- Table Body ------------------------------------------------------------------------------------------->
            <x-slot name="table_body">
                @forelse ($list as $index =>  $row)

                    <x-table.row>
                        <x-table.cell-text center>
                            {{ $index + 1 }}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{ $row->vname}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{ $row->description}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{ \Aaran\Welfare\Models\ProjectProduct::projectSegment($row->project_segment_id)}}
                        </x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>

                @empty
                    <x-table.empty/>
                @endforelse
            </x-slot>

            <x-slot name="table_pagination">
                {{ $list->links() }}
            </x-slot>
        </x-forms.table>

        <x-modal.delete/>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->
        <x-forms.create :id="$vid">
            <div class="flex flex-col gap-5">
                <x-input.model-text wire:model="vname" :label="'Project'"/>
                @error('vname')
                <span class="text-red-500">{{  $message }}</span>
                @enderror
                <x-input.model-text wire:model="description" :label="'Description'"/>
                <x-input.model-select wire:model="project_segment_id" :label="'Segment'">
                    <option class="text-gray-400"> choose ..</option>
                    @foreach($projectSegment as $segment)
                        <option value="{{$segment->id}}">{{$segment->vname}}</option>
                    @endforeach
                </x-input.model-select>
            </div>
        </x-forms.create>

    </x-forms.m-panel>
</div>
