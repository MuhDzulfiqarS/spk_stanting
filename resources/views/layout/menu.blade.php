<li class="nav-item">
    <a class="nav-link {{ Request::is('home') ? '':'collapsed' }}" href="{{ url('home') }}">
    
        <span>{{ $user->name }}</span>
    </a>
</li>

<!-- ADMIN -->
@if($user->level == 1)

<li class="nav-item">
  <a class="nav-link {{ Request::is('kriteria') ? '':'collapsed' }}"href="{{ url('kriteria') }}">
    <i class="fa-solid fa-clipboard"></i><span>Kriteria</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ Request::is('sub_kriteria') ? '':'collapsed' }}"href="{{ url('sub_kriteria') }}">
    <i class="fa-solid fa-clipboard"></i><span>Sub Kriteria</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ Request::is('balita') ? '':'collapsed' }}"href="{{ url('balita') }}">
    <i class="fa-solid fa-clipboard"></i><span>Alternatif</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ Request::is('nilai_alternatif') ? '':'collapsed' }}"href="{{ url('nilai_alternatif') }}">
    <i class="fa-solid fa-clipboard"></i><span>Penilaian Alternatif</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ Request::is('saw-result') ? '' : 'collapsed' }}" href="{{ url('saw-result') }}">
    <i class="fa-solid fa-calculator"></i><span>Proses Perhitungan</span>
  </a>
</li>




@endif