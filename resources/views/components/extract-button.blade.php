<div>
	<div class="card border-0 shadow-sm b text-app-gray overflow-hidden">
		<div class="card-body d-flex align-items-center justify-content-between">
			<form method="POST" action="{{ route('extract.convert') }}">
				@csrf
				@method('PATCH')
				<button type="submit" class="btn btn-primary">Extract to Warehouse</button>
			</form>

			@if ($warehouse?->last_extracted_at)
				<p class="mt-2 text-sm text-gray-500">Last extracted at: {{ $warehouse->last_extracted_at->format('Y-m-d H:i:s') }}
				</p>
			@else
				<p class="mt-2 text-sm text-gray-500">Not Extracted Yet</p>
			@endif
		</div>
	</div>
</div>
