
  <div class="px-4 pb-4 max-h-60 overflow-y-auto grid grid-cols-2 gap-4">
     @php
  $isLocal = app()->environment('local');
  $protocol = $isLocal ? 'http' : 'https';
  $domainSuffix = $isLocal ? '.test' : '.com';

  // Define apps and their ports (only for local)
  $apps = [
    ['name' => 'custospace', 'port' => '8001', 'title' => 'Manage Projects and Collaborate with Teams.'],
    ['name' => 'custohost', 'port' => '8002', 'title' => 'Find Accommodation & Housing, Manage Rentals, Hostels and Properties.'],
    ['name' => 'custosell', 'port' => '8003', 'title' => 'Buy, sell, Manage your stores from anywhere, anytime.'],
    ['name' => 'custospark', 'port' => '8000', 'title' => 'Accounts, Subscriptions, Analytics and Payments.'],
  ];
@endphp

@foreach($apps as $app)
  @php
    $portSegment = $isLocal ? ':' . $app['port'] : '';
    $url = "{$protocol}://{$app['name']}.custospark{$domainSuffix}{$portSegment}/dashboard";
  @endphp

  <a href="{{ $url }}" target="_blank" rel="noopener"
    class="group app-card bg-gray-50 hover:bg-blue-50 border border-gray-200 rounded-lg p-3 flex flex-col items-center text-center transition duration-200">
    <img src="{{ asset('images/v6.png') }}" alt="{{ ucfirst($app['name']) }}"
      class="w-12 h-12 mb-2 rounded-md shadow-sm group-hover:scale-105 transition" />
    <h2 class="text-sm font-semibold text-blue-600 break-words">{{ ucfirst($app['name']) }}</h2>
    <p class="text-xs text-gray-500 mt-1 break-words">{{ $app['title'] }}</p>
    <span class="mt-2 inline-flex items-center text-green-600 text-sm font-medium" aria-label="Active status">
      <i class="bi bi-check-circle-fill text-green-600 text-lg mr-1" aria-hidden="true"></i>
      Active
    </span>
  </a>
@endforeach
        </div>