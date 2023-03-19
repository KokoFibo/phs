<div>
    <select @change="cekWarna" name="pilihan" id="pilihan">
        <option value="Hijau">Hijau</option>
        <option value="Kuning">Kuning</option>
        <option value="Merah">Merah</option>
    </select>
    <script>
        function cekWarna(e) {
            console.log(e.pilihan);
            alert();
        }
    </script>
</div>
