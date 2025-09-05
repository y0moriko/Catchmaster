<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "Please log in first.";
    header("Location: login.php");
    exit();
}
include 'functions/get-func/get-fish.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'notifications/messages.php' ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Catches - CatchMaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/catch.css" rel="stylesheet">
    <style>

    .custom-modal {
        display: none; 
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 10000;
        overflow-y: auto;
        padding: 50px 20px;
    }
    .custom-modal.show {
        display: block;
    }

    .custom-modal-content {
        background: #fff;
        max-width: 600px;
        margin: auto;
        border-radius: 10px;
        padding: 25px 30px;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: addFishFadeIn 0.3s ease-out;
    }

    @keyframes addFishFadeIn {
        from {opacity: 0; transform: translateY(-20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .custom-modal-content h3 {
        margin-top: 0;
        margin-bottom: 20px;
        font-size: 1.5rem;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .custom-modal-content label {
        display: block;
        margin-bottom: 5px;
        margin-top: 15px;
        font-weight: 500;
        color: #374151;
    }

    .custom-modal-content input[type="text"],
    .custom-modal-content select,
    .custom-modal-content textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 1rem;
        color: #111827;
    }

    .custom-modal-content textarea {
        resize: vertical;
    }

    .custom-modal-content input[type="file"] {
        font-size: 0.9rem;
        margin-top: 5px;
    }

    #imagePreview {
        border-radius: 6px;
        border: 1px solid #d1d5db;
    }

    .custom-close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 1.5rem;
        color: #6b7280;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .custom-close-btn:hover {
        color: #111827;
    }

    .custom-actions {
        margin-top: 25px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .custom-btn-primary {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: background 0.2s ease;
    }

    .custom-btn-primary:hover {
        background-color: #2563eb;
    }

    .custom-btn-secondary {
        background-color: #e5e7eb;
        color: #374151;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: background 0.2s ease;
    }

    .custom-btn-secondary:hover {
        background-color: #d1d5db;
    }

    .custom-btn-danger {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
    }
        </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="modern-container">
        <!-- Breadcrumb -->
        <div class="modern-breadcrumb">
            <div class="breadcrumb-content">
                <nav class="breadcrumb-nav">
                    <span>You are here:</span>
                    <a href="index.php">Home</a>
                    <span>/</span>
                    <span>Fish Catches</span>
                </nav>
                <div class="search-container">
                    <input
                        id="globalSearch"
                        class="modern-search"
                        type="text"
                        placeholder="Search fish catches..."
                    >
                    <button class="search-btn" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Fish Catch Records</h1>
        </div>

        <!-- Table Data -->
        <div class="table-card">
            <div class="table-header">
                <h3 class="table-title">Recent Fish Catches</h3>
                <div class="table-filters">
                    <select class="filter-select">
                        <option>All Locations</option>
                        <option>Salvacion</option>
                        <option>Binagbag</option>
                        <option>Silangang Calutan</option>
                        <option>Kanlurang Calutan</option>
                        <option>Sildora</option>
                    </select>
                    <select class="filter-select">
                        <option>All Time</option>
                        <option>Today</option>
                        <option>This Week</option>
                        <option>This Month</option>
                    </select>
                    <button class="filter-btn">
                        <i class="fas fa-filter"></i>
                        Apply Filters
                    </button>
                    <button class="add-catch-btn" onclick="showAddFishModal()">
                        <i class="fas fa-plus"></i> Add Fish Catch
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" style="transform: scale(1.2);"></th>
                            <th>Fish Species</th>
                            <th>Quantity (kg)</th>
                            <th>Location</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'functions/fetch-func/fetch-catch.php' ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Delete Confirmation-->
    <div id="confirmDeleteModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-close-btn" onclick="closeModal('confirmDeleteModal')">&times;</span>
        <h3><i class="fas fa-exclamation-triangle" style="color:red;"></i> Confirm Deletion</h3>

        <p>Are you sure you want to delete <strong id="deleteFishName"></strong>? This action cannot be undone.</p>

        <div class="custom-actions">
        <button type="button" class="custom-btn-secondary" onclick="closeModal('confirmDeleteModal')">Cancel</button>
        <button type="button" class="custom-btn-danger" id="confirmDeleteBtn">
            <i class="fas fa-trash"></i> Yes, Delete
        </button>
        </div>
    </div>
    </div>

    <!--Add Modal-->
    <div id="addFishModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-close-btn" onclick="closeModal('addFishModal')">&times;</span>
        <h3><i class="fas fa-fish"></i> Add Fish Species</h3>

        <form action="functions/add-func/add-fish.php" method="post" enctype="multipart/form-data" novalidate>
        <label>Fish Name *</label>
        <input type="text" name="fish_name" required>

        <label>Scientific Name</label>
        <input type="text" name="scientific_name">

        <label>Local Name</label>
        <input type="text" name="local_name">

        <label>Family *</label>
        <input type="text" name="family" required>

        <label>Habitat *</label>
        <select name="habitat" required>
            <option value="">Select Habitat</option>
            <option value="Pelagic">Pelagic</option>
            <option value="Demersal">Demersal</option>
            <option value="Reef-associated">Reef-associated</option>
            <option value="Invertebrate">Invertebrate</option>
        </select>

        <label>Image</label>
        <input type="file" name="image" accept="image/*" onchange="previewImage(event)">
        <img id="imagePreview" style="display:none; max-width:100px; margin-top:10px;">

        <label>Description *</label>
        <textarea name="fish_description" required rows="3"></textarea>

        <div class="custom-actions">
            <button type="button" class="custom-btn-secondary" onclick="closeModal('addFishModal')">Cancel</button>
            <button type="submit" class="custom-btn-primary">Save Species</button>
        </div>
        </form>
    </div>
    </div>

    <!--Edit Modal-->
    <div id="editFishModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-close-btn" onclick="closeModal('editFishModal')">&times;</span>
        <h3><i class="fas fa-edit"></i> Edit Fish Species</h3>

        <div id="editFishContent">

        <p>Loading...</p>
        </div>
    </div>
    </div>


    <script>
        function openModal(id) {
        document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
        document.getElementById(id).style.display = 'none';
        }

        // Add Fish modal
        function showAddFishModal() {
        openModal('addFishModal');
        }

        // Delete modal
        let deleteCatchUrl = '';
        function showDeleteModal(url, fishName) {
        deleteCatchUrl = url;
        document.getElementById('deleteFishName').textContent = fishName || '';
        openModal('confirmDeleteModal');
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteCatchUrl) window.location.href = deleteCatchUrl;
        });

        // Edit Fish modal
        function editFish(fishId) {
        fetch(`functions/fetch-func/fetch-single-fish.php?id=${fishId}`)
            .then(res => res.json())
            .then(fishData => {
            document.getElementById('editFishContent').innerHTML = `
                <form action="functions/update-func/update-fish.php" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="fish_id" value="${fishData.fish_id}">

                <label>Fish Name *</label>
                <input type="text" name="fish_name" value="${fishData.fish_name}" required>

                <label>Scientific Name</label>
                <input type="text" name="scientific_name" value="${fishData.scientific_name || ''}">

                <label>Local Name</label>
                <input type="text" name="local_name" value="${fishData.local_name || ''}">

                <label>Family *</label>
                <input type="text" name="family" value="${fishData.family}" required>

                <label>Habitat *</label>
                <select name="habitat" required>
                    <option value="Pelagic" ${fishData.habitat === 'Pelagic' ? 'selected' : ''}>Pelagic</option>
                    <option value="Demersal" ${fishData.habitat === 'Demersal' ? 'selected' : ''}>Demersal</option>
                    <option value="Reef-associated" ${fishData.habitat === 'Reef-associated' ? 'selected' : ''}>Reef-associated</option>
                    <option value="Invertebrate" ${fishData.habitat === 'Invertebrate' ? 'selected' : ''}>Invertebrate</option>
                </select>

                <label>Description *</label>
                <textarea name="fish_description" rows="3" required>${fishData.fish_description || ''}</textarea>

                <div class="custom-actions">
                    <button type="button" class="custom-btn-secondary" onclick="closeModal('editFishModal')">Cancel</button>
                    <button type="submit" class="custom-btn-primary">Update</button>
                </div>
                </form>
            `;
            openModal('editFishModal');
            })
            .catch(err => console.error('Error fetching fish:', err));
        }

        document.getElementById('globalSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            
        });

        function markProcessed(catchId) {
            if (confirm('Mark this catch as Processed?')) {
                window.location.href = 'functions/update-func/update-status.php?id=' + catchId;
            }
        }
    </script>
</body>
</html>
