  

<script>
   
      
        $(document).ready(function(){
      
      $('.table.table-bordered input#volume_Task').on('input', function(){
          var volume = $(this).val();
          var harga = $(this).closest('.table').find('input#UnitPrice').val();
          var total = volume * harga;
          
          // Konversi nilai total ke format mata uang Rupiah
          var totalRupiah = formatRupiah(total);
          
          // Masukkan hasil perhitungan ke dalam input Ttl_Price
          $(this).closest('.table').find('input#Ttl_Price').val(totalRupiah);
      });
  });

  // Fungsi untuk mengonversi angka ke format mata uang Rupiah
  function formatRupiah(angka) {
      var reverse = angka.toString().split('').reverse().join(''),
          ribuan = reverse.match(/\d{1,3}/g);
      ribuan = ribuan.join('.').split('').reverse().join('');
      return 'Rp ' + ribuan;
  }

</script>

<script>
    function cetakLaporan(url) {
        var printWindow = window.open(url, '_blank'); // Perbaikan disini, mengganti ":" menjadi "="
        printWindow.onload = function() {
            printWindow.print();
            printWindow.onafterprint = function() {
                printWindow.close();
            };
        };
    }
    </script>

<body>
    
    <div class="modal fade" id="editModal{{$item->Id_Job_SPK}}" tabindex="-1" style="display: none" aria-labelledby="editModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">No SPK : {{$item->NoSPK}} </h5>
 

                    <a href="#" id="printLPAButton" target="_blank" onclick="cetakLaporan('{{ route('laporan', ['Id_Job_SPK' => $item->Id_Job_SPK]) }}');">
                        <i class="fas fa-print"></i> Print LPA
                    </a>
                    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                   
                <div class="modal-body">
                    <div id="data-real-container">
                   
                        <div class="auto">
                     <table class="table table-bordered" id="mytable{{ $item->Id_Job_SPK }}">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>realisasi_WP</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>

                       
                        <tbody id="cek">
                            @if ($item->real()->count() > 0)
                            @foreach($item->real()->get() as $pos)
                            <tr >
                                <td>{{ $pos->Kode }}</td>
                                <td class="truncate-text">{{ $pos->realisasi_WP }}</td>

                                <td>{{ $pos->volume_Task }}</td>
                                <td>{{ $pos->Satuan }}</td>
                                <td>{{ $pos->UnitPrice }}</td>
                                <td>Rp {{ number_format($pos->Ttl_Price, 0, ',', '.') }}</td>

                                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                            </tr>
                        
                            @endforeach
                            @else
                            <tr class="tdk-ada-data">
                                <td colspan="6">Tidak ada data</td>
                            </tr>
                            
                           
                        
                        @endif
                            <!-- Tambahkan kolom lainnya sesuai dengan kebutuhan -->
                        </tbody>
                    
                    </table>
                </div>
                    <div id="pagination-container" class="d-flex justify-content-center">
                        <!-- Tombol paginasi akan dimuat di sini menggunakan AJAX -->
                    </div>
                    <div id="alert-container"></div>
                    <form action="{{ route('tambah-data', $item->Id_Job_SPK) }}"class="form-edit" method="POST"id="add" data-id="{{ $item->kode }}">
                        @csrf
                        <br>
                        <br>
                        <div class="form-group">
                            <div class="col-md-5">
                            <label for="Kode">Kode</label>
                            <input type="text" class="form-control" id="Kode" name="Kode" >
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div>
                                <label for="realisasi_WP">Realisasi WP</label>
                            </div>
                          
                            <div class="row">
                                <div class="col-md-10">
                                    <textarea name="realisasi_WP" id="realisasi_WP" cols="70" rows="6" >

                                    </textarea>  
                                </div>
                                
                            <div class="col-md-1">
                             
                               
                                    <button type="submit" class="btn btn-outline-success tambah-button" id='tambah' data-data1-id="{{ $item->Id_Job_SPK }}" >Save</button>
                                   
                                    <div style="margin-top: 20px;"></div>
                                    <button type="button"class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
                                
                            </div>

                            </div>

                       
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="volume_Task">Volume Task</label>
                                    <input type="number" class="form-control" id="volume_Task" name="volume_Task" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Satuan">Satuan</label>
                                    <input type="text" class="form-control" id="Satuan" name="Satuan" >
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UnitPrice">Harga Satuan</label>
                                    <input type="text" class="form-control" id="UnitPrice" name="UnitPrice" value="3000" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Ttl_Price">Total:</label>
                                    <input type="text" class="form-control" id="Ttl_Price" name="Ttl_Price" readonly>
                                </div>
                            </div>
                        </div>
                          
                        <!-- Tambahkan input untuk kolom lainnya sesuai dengan kebutuhan -->
                       

                  
                    </form>
            </div>
        </div>
            
            </div>
        </div>
    </div>


  
</body>