<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ auth()->user()->role }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        /* Reset default margin dan padding */
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Background with gradient and subtle pattern */
        body {
            background: linear-gradient(135deg, #e6f0ff 0%, #d9e7ff 50%, #c6d9ff 100%);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(255,255,255,0.3) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255,255,255,0.3) 0%, transparent 20%);
            background-attachment: fixed;
        }
        
        /* Full width container */
        .full-width-container {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        /* Enhanced profile card */
        .profile-card {
            max-width: 800px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            position: relative;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
            border-radius: 50px;
            padding: 8px 15px;
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
            transition: all 0.3s ease;
        }
        
        .back-button:hover {
            transform: translateX(-3px);
            box-shadow: 0 6px 20px rgba(106, 17, 203, 0.4);
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }
        
        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 5px solid #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .profile-header h2 {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
            position: relative;
            display: inline-block;
        }
        
        .profile-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            border-radius: 3px;
        }
        
        .profile-header p {
            color: #7f8c8d;
            font-size: 1.1rem;
            margin-top: 15px;
        }
        
        .profile-details {
            margin-top: 30px;
        }
        
        .detail-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .detail-item h5 {
            color: #3498db;
            font-weight: 600;
            margin-bottom: 15px;
            position: relative;
            padding-left: 15px;
        }
        
        .detail-item h5::before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            height: 60%;
            width: 4px;
            background: linear-gradient(to bottom, #6a11cb 0%, #2575fc 100%);
            border-radius: 2px;
        }
        
        .detail-item p {
            color: #555;
            margin-bottom: 8px;
        }
        
        .detail-item strong {
            color: #2c3e50;
            font-weight: 600;
        }
        
        .nav-tabs .nav-link.active {
            font-weight: bold;
            color: #2575fc;
            background-color: transparent;
            border-bottom: 3px solid #2575fc;
        }
        
        .nav-tabs .nav-link {
            color: #7f8c8d;
            border: none;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link:hover {
            color: #2575fc;
            background-color: rgba(37, 117, 252, 0.05);
        }
        
        /* Loading spinner */
        .spinner-border {
            display: none;
            width: 1.5rem;
            height: 1.5rem;
        }
        
        /* Custom primary button */
        .btn-primary {
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(106, 17, 203, 0.4);
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        }
        
        /* Modal styling */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .modal-title {
            font-weight: 700;
            color: #2c3e50;
        }
        
        /* Custom CSS for full-screen layout */
        body {
            overflow: hidden;
        }
        
        .sticky-top {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1020;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Floating circles decoration */
        .floating-circles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(106, 17, 203, 0.05);
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
            }
        }
    </style>
</head>
<body>
    <!-- Floating background circles -->
    <div class="floating-circles">
        <div class="circle" style="width: 300px; height: 300px; top: 10%; left: 5%;"></div>
        <div class="circle" style="width: 200px; height: 200px; top: 70%; left: 80%;"></div>
        <div class="circle" style="width: 150px; height: 150px; top: 30%; left: 75%;"></div>
        <div class="circle" style="width: 250px; height: 250px; top: 80%; left: 15%;"></div>
        <div class="circle" style="width: 100px; height: 100px; top: 60%; left: 50%;"></div>
    </div>

    <!-- Container utama full width -->
    <div class="d-flex flex-column min-vh-100">
        @if(auth()->user()->role === 'master')
            @include('dashboard.master')
        @elseif(auth()->user()->role === 'pemilik')
            @include('dashboard.pemilik')
        @else
            <!-- Dashboard Pengguna - Tampilan Profil -->
            <div class="user-dashboard">
                <div class="profile-card">
                    <!-- Back Button -->
                    <button type="button" onclick="window.history.back()"
                    class="btn btn-secondary back-button">
                    <i class="fas fa-arrow-left me-2"></i> Kembali</button>
                    
                    <div class="profile-header">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random&color=fff&size=256" 
                             alt="Profile" class="profile-avatar" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <h2>{{ auth()->user()->name }}</h2>
                        <p class="text-muted"><i class="fas fa-user-circle me-2"></i>Anda login sebagai Pengguna</p>
                    </div>
                    
                    <div class="profile-details">
                        <div class="detail-item">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi Akun</h5>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <p><strong><i class="fas fa-user me-2"></i>Nama Lengkap:</strong><br>
                                    <span class="text-dark">{{ auth()->user()->name }}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong><i class="fas fa-envelope me-2"></i>Email:</strong><br>
                                    <span class="text-dark">{{ auth()->user()->email }}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong><i class="fas fa-phone me-2"></i>No Telepon:</strong><br>
                                    <span class="text-dark">{{ auth()->user()->no_telepon ?? '-' }}</span></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <h5><i class="fas fa-id-card me-2"></i>Detail Profil</h5>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <p><strong><i class="fas fa-calendar-plus me-2"></i>Bergabung Pada:</strong><br>
                                    <span class="text-dark">{{ auth()->user()->created_at->format('d F Y') }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong><i class="fas fa-user-tag me-2"></i>Peran:</strong><br>
                                    <span class="text-dark">{{ ucfirst(auth()->user()->role) }}</span></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-5">
                            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="fas fa-edit me-2"></i>Edit Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Edit Profil -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfileModalLabel"><i class="fas fa-user-edit me-2"></i>Edit Profil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                                        <i class="fas fa-user me-2"></i>Profil
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">
                                        <i class="fas fa-key me-2"></i>Ubah Password
                                    </button>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="profileTabsContent">
                                <!-- Tab Profil -->
                                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3 text-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random&color=fff&size=256" 
                                                 alt="Profile" class="profile-avatar mb-3">
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                                <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="no_telepon" class="form-label"><i class="fas fa-phone me-2"></i>No Telepon</label>
                                                <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="{{ auth()->user()->no_telepon ?? '' }}" required>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Tab Password -->
                                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                    <form id="passwordForm" action="{{ route('profile.password') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label"><i class="fas fa-lock me-2"></i>Password Saat Ini</label>
                                            <input type="password" class="form-control" name="current_password" id="currentPassword" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label"><i class="fas fa-key me-2"></i>Password Baru</label>
                                            <input type="password" class="form-control" name="new_password" id="newPassword" required>
                                            <div class="form-text">Minimal 8 karakter</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label"><i class="fas fa-check-circle me-2"></i>Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" name="new_password_confirmation" id="confirmPassword" required>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Tutup</button>
                            <button type="button" class="btn btn-primary" id="saveProfileChanges">
                                <span class="spinner-border spinner-border-sm" id="spinner"></span>
                                <span id="saveButtonText"><i class="fas fa-save me-2"></i>Simpan Perubahan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveButton = document.getElementById('saveProfileChanges');
            const spinner = document.getElementById('spinner');
            const saveButtonText = document.getElementById('saveButtonText');
            
            saveButton.addEventListener('click', function() {
                const activeTab = document.querySelector('.tab-pane.active');
                
                if (activeTab.id === 'profile') {
                    updateProfile();
                } else {
                    updatePassword();
                }
            });

            function showLoading() {
                spinner.style.display = 'inline-block';
                saveButtonText.innerHTML = 'Menyimpan...';
                saveButton.disabled = true;
            }

            function hideLoading() {
                spinner.style.display = 'none';
                saveButtonText.innerHTML = '<i class="fas fa-save me-2"></i>Simpan Perubahan';
                saveButton.disabled = false;
            }

            function showSuccessAlert(title, message) {
                Swal.fire({
                    title: title,
                    text: message,
                    icon: 'success',
                    confirmButtonColor: '#2575fc',
                    confirmButtonText: 'OK',
                    background: '#ffffff',
                    backdrop: `
                        rgba(106, 17, 203, 0.1)
                    `
                });
            }

            function showErrorAlert(title, message) {
                Swal.fire({
                    title: title,
                    html: message,
                    icon: 'error',
                    confirmButtonColor: '#2575fc',
                    confirmButtonText: 'OK',
                    background: '#ffffff',
                    backdrop: `
                        rgba(106, 17, 203, 0.1)
                    `
                });
            }

            function updateProfile() {
                const form = document.getElementById('profileForm');
                const formData = new FormData(form);
                
                showLoading();
                
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    hideLoading();
                    if (data.success) {
                        showSuccessAlert('Berhasil!', 'Profil berhasil diperbarui');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        if (data.errors) {
                            let errorMessage = '<ul>';
                            for (const field in data.errors) {
                                errorMessage += `<li>${data.errors[field].join(', ')}</li>`;
                            }
                            errorMessage += '</ul>';
                            showErrorAlert('Gagal!', errorMessage);
                        } else {
                            showErrorAlert('Gagal!', data.message || 'Gagal memperbarui profil');
                        }
                    }
                })
                .catch(error => {
                    hideLoading();
                    console.error('Error:', error);
                    showErrorAlert('Error!', 'Terjadi kesalahan saat memperbarui profil');
                });
            }

            function updatePassword() {
                const form = document.getElementById('passwordForm');
                const formData = new FormData(form);
                
                // Validasi client-side
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                if (newPassword.length < 8) {
                    showErrorAlert('Gagal!', 'Password baru harus minimal 8 karakter!');
                    return;
                }
                
                if (newPassword !== confirmPassword) {
                    showErrorAlert('Gagal!', 'Password baru dan konfirmasi tidak cocok!');
                    return;
                }
                
                showLoading();
                
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    hideLoading();
                    if (data.success) {
                        showSuccessAlert('Berhasil!', 'Password berhasil diubah');
                        form.reset();
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
                        modal.hide();
                    } else {
                        if (data.errors) {
                            let errorMessage = '<ul>';
                            for (const field in data.errors) {
                                errorMessage += `<li>${data.errors[field].join(', ')}</li>`;
                            }
                            errorMessage += '</ul>';
                            showErrorAlert('Gagal!', errorMessage);
                        } else {
                            showErrorAlert('Gagal!', data.message || 'Gagal mengubah password');
                        }
                    }
                })
                .catch(error => {
                    hideLoading();
                    console.error('Error:', error);
                    showErrorAlert('Error!', 'Terjadi kesalahan saat mengubah password');
                });
            }
            
            // Create floating circles dynamically
            function createCircles() {
                const container = document.querySelector('.floating-circles');
                for (let i = 0; i < 8; i++) {
                    const circle = document.createElement('div');
                    circle.classList.add('circle');
                    const size = Math.random() * 200 + 50;
                    const left = Math.random() * 100;
                    const top = Math.random() * 100;
                    const opacity = Math.random() * 0.1 + 0.05;
                    const animationDuration = Math.random() * 20 + 10;
                    
                    circle.style.width = `${size}px`;
                    circle.style.height = `${size}px`;
                    circle.style.left = `${left}%`;
                    circle.style.top = `${top}%`;
                    circle.style.opacity = opacity;
                    circle.style.animationDuration = `${animationDuration}s`;
                    circle.style.animationDelay = `${Math.random() * 10}s`;
                    
                    container.appendChild(circle);
                }
            }
            
            createCircles();
        });
    </script>
</body>
</html>