namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\User;
use App\Models\KategoriBarang;
use App\Models\Kelayakan;
use App\Models\Ketersediaan;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
public function index()
{
$inventaris = Inventaris::with(['user', 'kategoriBarang', 'ketersediaan', 'kelayakan'])->get();
$users = User::all();
$kategori = KategoriBarang::all();
$kelayakan = Kelayakan::all();
$ketersediaan = Ketersediaan::all();
return view('inventaris.index', compact('inventaris', 'users', 'kategori', 'kelayakan', 'ketersediaan'));
}

public function store(Request $request)
{
$request->validate([
'item_name' => 'required',
'amount' => 'required|integer',
'user_id' => 'required',
'category_id' => 'required',
'ketersediaan_id' => 'required',
'kelayakan_id' => 'required',
'deskripsi' => 'nullable',
]);

Inventaris::create($request->all());
return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil ditambahkan.');
}

public function update(Request $request, $id)
{
$inventaris = Inventaris::findOrFail($id);

$request->validate([
'item_name' => 'required',
'amount' => 'required|integer',
'user_id' => 'required',
'category_id' => 'required',
'ketersediaan_id' => 'required',
'kelayakan_id' => 'required',
'deskripsi' => 'nullable',
]);

$inventaris->update($request->all());
return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diupdate.');
}

public function destroy($id)
{
Inventaris::destroy($id);
return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil dihapus.');
}
}