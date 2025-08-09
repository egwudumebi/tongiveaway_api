<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }
        
        .sidebar .nav-link {
            color: #495057;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin: 0.125rem 0;
        }
        
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            color: #212529;
        }
        
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }
        
        .main-content {
            min-height: 100vh;
        }
        
        .stats-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .wallet-address {
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(45deg, #007bff, #6610f2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.75rem;
        }
        
        .sidebar-brand {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 1rem;
        }
        
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem;
            border-top: 1px solid #dee2e6;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                z-index: 1050;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                display: none;
            }
            
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
             Sidebar 
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar d-flex flex-column">
                     Sidebar Brand 
                    <div class="sidebar-brand">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded p-2 me-2">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Admin Dashboard</h6>
                                <small class="text-muted">User Management</small>
                            </div>
                        </div>
                    </div>
                    
                     Navigation 
                    <nav class="nav flex-column px-3">
                        <h6 class="text-muted text-uppercase fw-bold mb-2 mt-3">Navigation</h6>
                        <a class="nav-link active" href="#" data-section="users">
                            <i class="bi bi-people me-2"></i>
                            All Users
                        </a>
                        <a class="nav-link" href="#" data-section="wallets">
                            <i class="bi bi-wallet2 me-2"></i>
                            Wallet Management
                        </a>
                        <a class="nav-link" href="#" data-section="reports">
                            <i class="bi bi-graph-up me-2"></i>
                            Financial Reports
                        </a>
                    </nav>
                    
                     Sidebar Footer 
                    <div class="sidebar-footer">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="user-avatar me-2">AD</div>
                                <span>Admin User</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-question-circle me-2"></i>Support</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
             Mobile Sidebar Overlay 
            <div class="sidebar-overlay" id="sidebarOverlay"></div>
            
             Main Content 
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                     Header 
                    <header class="border-bottom py-3 px-4 mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-secondary d-md-none me-3" id="sidebarToggle">
                                    <i class="bi bi-list"></i>
                                </button>
                                <div>
                                    <h1 class="h4 mb-0">User Management</h1>
                                    <p class="text-muted mb-0">Manage and monitor all registered users</p>
                                </div>
                            </div>
                        </div>
                    </header>
                    
                     Stats Cards 
                    <div class="row mb-4 px-4">
                        <div class="col-md-4 mb-3">
                            <div class="card stats-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title text-muted mb-2">Total Users</h6>
                                            <h2 class="mb-0" id="totalUsers">6</h2>
                                            <small class="text-muted" id="activeUsersText">4 active users</small>
                                        </div>
                                        <div class="text-muted">
                                            <i class="bi bi-people fs-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card stats-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title text-muted mb-2">Total Balance</h6>
                                            <h2 class="mb-0" id="totalBalance">$8,066</h2>
                                            <small class="text-muted">Across all wallets</small>
                                        </div>
                                        <div class="text-muted">
                                            <i class="bi bi-currency-dollar fs-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card stats-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title text-muted mb-2">Active Wallets</h6>
                                            <h2 class="mb-0" id="activeWallets">4</h2>
                                            <small class="text-muted" id="activePercentage">66.7% of total</small>
                                        </div>
                                        <div class="text-muted">
                                            <i class="bi bi-wallet2 fs-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     Users Table 
                    <div class="px-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Registered Users</h5>
                                        <p class="text-muted mb-0">A list of all registered users with their wallet information</p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="input-group" style="width: 300px;">
                                            <span class="input-group-text">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Search users..." id="searchInput">
                                        </div>
                                        <button class="btn btn-outline-secondary">
                                            <i class="bi bi-funnel me-1"></i>
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>User</th>
                                                <th>Wallet Address</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Joined</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="usersTableBody">
                                             Users will be populated by JavaScript 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mock user data
        const users = [
            {
                id: 1,
                email: "alice.johnson@example.com",
                walletAddress: "0x742d35Cc6634C0532925a3b8D4C0532925a3b8D4",
                balance: 1250.75,
                status: "active",
                joinedDate: "2024-01-15",
            },
            {
                id: 2,
                email: "bob.smith@example.com",
                walletAddress: "0x8ba1f109551bD432803012645Hac189451b934",
                balance: 890.25,
                status: "active",
                joinedDate: "2024-02-03",
            },
            {
                id: 3,
                email: "carol.davis@example.com",
                walletAddress: "0x1f9840a85d5aF5bf1D1762F925BDADdC4201F984",
                balance: 2100.5,
                status: "inactive",
                joinedDate: "2024-01-28",
            },
            {
                id: 4,
                email: "david.wilson@example.com",
                walletAddress: "0xA0b86a33E6441b8dB2B2B0B8B8B8B8B8B8B8B8B8",
                balance: 450.0,
                status: "active",
                joinedDate: "2024-03-10",
            },
            {
                id: 5,
                email: "emma.brown@example.com",
                walletAddress: "0x6B175474E89094C44Da98b954EedeAC495271d0F",
                balance: 3250.8,
                status: "active",
                joinedDate: "2024-01-05",
            },
            {
                id: 6,
                email: "frank.miller@example.com",
                walletAddress: "0xdAC17F958D2ee523a2206206994597C13D831ec7",
                balance: 125.3,
                status: "suspended",
                joinedDate: "2024-02-20",
            },
        ];

        // Utility functions
        function formatWalletAddress(address) {
            return `${address.slice(0, 6)}...${address.slice(-4)}`;
        }

        function getStatusBadge(status) {
            const badges = {
                active: 'success',
                inactive: 'secondary',
                suspended: 'danger'
            };
            return `<span class="badge bg-${badges[status] || 'secondary'}">${status}</span>`;
        }

        function getUserInitials(email) {
            return email.slice(0, 2).toUpperCase();
        }

        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString();
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(amount);
        }

        // Render users table
        function renderUsersTable(usersToRender = users) {
            const tbody = document.getElementById('usersTableBody');
            tbody.innerHTML = '';

            usersToRender.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-3">${getUserInitials(user.email)}</div>
                            <div>
                                <div class="fw-medium">${user.email}</div>
                                <small class="text-muted">ID: ${user.id}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="wallet-address">${formatWalletAddress(user.walletAddress)}</span>
                    </td>
                    <td>
                        <span class="fw-medium">${formatCurrency(user.balance)}</span>
                    </td>
                    <td>
                        ${getStatusBadge(user.status)}
                    </td>
                    <td>
                        <small>${formatDate(user.joinedDate)}</small>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Actions</h6></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit User</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pause me-2"></i>Suspend User</a></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete User</a></li>
                            </ul>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Update statistics
        function updateStats() {
            const totalUsers = users.length;
            const activeUsers = users.filter(user => user.status === 'active').length;
            const totalBalance = users.reduce((sum, user) => sum + user.balance, 0);

            document.getElementById('totalUsers').textContent = totalUsers;
            document.getElementById('activeUsersText').textContent = `${activeUsers} active users`;
            document.getElementById('totalBalance').textContent = formatCurrency(totalBalance);
            document.getElementById('activeWallets').textContent = activeUsers;
            document.getElementById('activePercentage').textContent = `${((activeUsers / totalUsers) * 100).toFixed(1)}% of total`;
        }

        // Search functionality
        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const filteredUsers = users.filter(user => 
                    user.email.toLowerCase().includes(searchTerm) ||
                    user.walletAddress.toLowerCase().includes(searchTerm)
                );
                renderUsersTable(filteredUsers);
            });
        }

        // Mobile sidebar toggle
        function setupMobileSidebar() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }

        // Navigation handling
        function setupNavigation() {
            const navLinks = document.querySelectorAll('.nav-link[data-section]');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Here you could implement section switching logic
                    const section = this.dataset.section;
                    console.log(`Switching to section: ${section}`);
                });
            });
        }

        // Initialize the dashboard
        document.addEventListener('DOMContentLoaded', function() {
            renderUsersTable();
            updateStats();
            setupSearch();
            setupMobileSidebar();
            setupNavigation();
        });
    </script>
</body>
</html>