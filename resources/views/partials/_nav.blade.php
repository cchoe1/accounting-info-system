<nav id="navbar" class="navbar-expand-lg navbar-light">
	<div class="navbar-company-name">
		<a href="/">{{ $company_name }}</a>
	</div>

	<div class="navbar-links">
			
		{{-- <a href="/" class='btn btn-sm btn-outline-dark'>Home</a> --}}
		{{-- <a href="/invoice" class='btn btn-sm btn-outline-dark'>Invoices</a> --}}
		{{-- <a href="/customer" class='btn btn-sm btn-outline-dark'>Customers</a> --}}
		<a href="/ledger" class='btn btn-sm btn-outline-dark'>General Ledger</a>
		
		<div class="dropdown">
			<button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Incomes
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="/invoice">Invoices</a>
				<a class="dropdown-item" href="/sale">Sales</a>
				<a class="dropdown-item" href="/inventory">Inventory</a>
			</div>
		</div>
		{{-- <a href="/vendor" class='btn btn-sm btn-outline-dark'>Vendors</a> --}}
		<div class="dropdown">
			<button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Expenses
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="/bill">Bills</a>
				<a class="dropdown-item" href="/purchase">Purchases</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Relations
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="/vendor">Vendors</a>
				<a class="dropdown-item" href="/customer">Customers</a>
			</div>
		</div>
		{{-- <a href="/compose" class='btn btn-sm btn-outline-dark'>Reports and Statements</a> --}}
		<div class="dropdown">
			<button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Reports
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="/compose/income">Income Statement</a>
				<a class="dropdown-item" href="/compose/balance-sheet">Balance Sheet</a>
				<a class="dropdown-item" href="/compose/cash-flows">Cash Flows</a>
				<a class="dropdown-item" href="/compose/cash-flows">A/R Schedule</a>
				<a class="dropdown-item" href="/compose/cash-flows">Inventory Report</a>
				<a class="dropdown-item" href="/compose/cash-flows">Book of Accounts</a>
			</div>
		</div>
		<a href="/setting/home" class='btn btn-sm btn-outline-dark'>Settings</a>
		<a href="/help" class='btn btn-sm btn-outline-dark'>Help</a>
	</div>
</nav>