<?php

namespace App\Livewire\Audit\SalesTrack\Rootline;

use Aaran\Audit\Models\SalesTrack\Rootline;
use App\Livewire\Trait\CommonTrait;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    #region[save]
    public function getSave(): string
    {
        if ($this->vname != '') {
            if ($this->vid == "") {
                Rootline::create([
                    'vname' => Str::ucfirst($this->vname),
                    'active_id' => $this->active_id,
                    'user_id' => auth()->id(),
                ]);
                $message = "Saved";

            } else {
                $obj = Rootline::find($this->vid);
                $obj->vname = Str::ucfirst($this->vname);
                $obj->active_id = $this->active_id;
                $obj->user_id = auth()->id();
                $obj->save();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
        return '';
    }
    #endregion

    #region[obj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Rootline::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[list]
    public function getList()
    {
        return Rootline::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy('id', $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[render]
    public function render()
    {
        return view('livewire.audit.sales-track.rootline.index')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}
