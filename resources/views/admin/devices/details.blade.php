<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .device-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            padding: 15px;
        }

        .device-logo {
            text-align: center;
            padding: 20px 0;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
        }

        .device-logo img {
            max-height: 60px;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 50px;
            color: white;
            font-weight: bold;
            display: inline-block;
            margin-top: 5px;
        }

        .status-active {
            background-color: #28a745;
        }

        .status-inactive {
            background-color: #dc3545;
        }

        .info-section {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .info-section:last-child {
            border-bottom: none;
        }

        .info-section h5 {
            color: #007bff;
            margin-bottom: 15px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .info-section h5 i {
            margin-right: 10px;
        }

        .info-item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #eee;
        }

        .info-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-item .label {
            font-weight: bold;
            color: #555;
        }

        .info-item .value {
            color: #333;
        }

        .location-container {
            position: relative;
            width: 100%;
            margin-top: 15px;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .location-container img {
            width: 100%;
            height: auto;
        }

        .marker {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            border: 2px solid white;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .photo-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .photo-item {
            width: calc(50% - 5px);
            position: relative;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .photo-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .photo-item .photo-caption {
            padding: 5px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
            font-size: 12px;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
            font-size: 14px;
            color: #777;
        }

        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }

            .card-header {
                padding: 10px 15px;
            }

            .photo-item {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="device-logo mb-4">
            <img src="{{ asset('logo.png') }}" alt="Company Logo">
        </div>

        <div class="device-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">DEV-001</h4>
                <span class="status-badge status-active">Active</span>
            </div>

            <div class="card-body p-0">
                <!-- Basic Information -->
                <div class="info-section">
                    <h5><i class="fas fa-info-circle"></i> Basic Information</h5>

                    <div class="info-item row">
                        <div class="col-5 label">Device Type:</div>
                        <div class="col-7 value">Router</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Serial Number:</div>
                        <div class="col-7 value">SN-12345678</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Status:</div>
                        <div class="col-7 value">
                            <span class="status-badge status-active">Active</span>
                        </div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Last Updated:</div>
                        <div class="col-7 value">16 Mar 2025</div>
                    </div>
                </div>

                <!-- Technical Specifications -->
                <div class="info-section">
                    <h5><i class="fas fa-cogs"></i> Technical Specifications</h5>

                    <div class="info-item row">
                        <div class="col-5 label">Model:</div>
                        <div class="col-7 value">Cisco RV340</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Ports:</div>
                        <div class="col-7 value">4x Gigabit Ethernet, 2x USB</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Firewall Throughput:</div>
                        <div class="col-7 value">900 Mbps</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">VPN Throughput:</div>
                        <div class="col-7 value">150 Mbps</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Power Supply:</div>
                        <div class="col-7 value">12V 2A</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Firmware:</div>
                        <div class="col-7 value">v2.0.3.18</div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="info-section">
                    <h5><i class="fas fa-map-marker-alt"></i> Location Information</h5>

                    <div class="info-item row">
                        <div class="col-5 label">Building:</div>
                        <div class="col-7 value">Gedung A - Pusat Data</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Floor:</div>
                        <div class="col-7 value">3rd Floor</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Room:</div>
                        <div class="col-7 value">Server Room 302</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Rack:</div>
                        <div class="col-7 value">Rack 05-B</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Position:</div>
                        <div class="col-7 value">U24-U25</div>
                    </div>

                    <div class="info-item row">
                        <div class="col-5 label">Notes:</div>
                        <div class="col-7 value">Connected to main power supply and backup generator</div>
                    </div>

                    <div class="location-container">
                        <img src="{{ asset('uploads/gedung/photo/building-a.jpg') }}" alt="Building Map">
                        <!-- Marker at 50% from left, 40% from top -->
                        <div class="marker" style="left: 50%; top: 40%;"></div>
                    </div>
                </div>

                <!-- Device Photos -->
                <div class="info-section">
                    <h5><i class="fas fa-images"></i> Device Photos</h5>

                    <div class="photo-gallery">
                        <div class="photo-item">
                            <img src="{{ asset('uploads/devices/device_front.jpg') }}" alt="Front View">
                            <div class="photo-caption">Front View</div>
                        </div>
                        <div class="photo-item">
                            <img src="{{ asset('uploads/devices/device_back.jpg') }}" alt="Back View">
                            <div class="photo-caption">Back View</div>
                        </div>
                        <div class="photo-item">
                            <img src="{{ asset('uploads/devices/device_installed.jpg') }}" alt="Installed in Rack">
                            <div class="photo-caption">Installed in Rack</div>
                        </div>
                        <div class="photo-item">
                            <img src="{{ asset('uploads/devices/device_serial.jpg') }}" alt="Serial Number">
                            <div class="photo-caption">Serial Number</div>
                        </div>
                    </div>
                </div>

                <!-- Maintenance History (Last 3 entries) -->
                <div class="info-section">
                    <h5><i class="fas fa-tools"></i> Recent Maintenance</h5>

                    <div class="table-responsive">
                        <table class="table table-sm table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Performed By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>15 Mar 2025</td>
                                    <td>Firmware Update</td>
                                    <td>John Technician</td>
                                </tr>
                                <tr>
                                    <td>10 Feb 2025</td>
                                    <td>Preventive Maintenance</td>
                                    <td>Sarah Engineer</td>
                                </tr>
                                <tr>
                                    <td>05 Jan 2025</td>
                                    <td>Cable Replacement</td>
                                    <td>John Technician</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Report Issue Button -->
                <div class="info-section text-center">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#reportIssueModal">
                        <i class="fas fa-exclamation-triangle me-2"></i>Report Issue
                    </button>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>This information is provided for reference only.<br>© 2025 Network Management System</p>
        </div>
    </div>

    <!-- Report Issue Modal -->
    <div class="modal fade" id="reportIssueModal" tabindex="-1" aria-labelledby="reportIssueModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportIssueModalLabel">Report an Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="issueForm">
                        <div class="mb-3">
                            <label for="reporterName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="reporterName" required>
                        </div>
                        <div class="mb-3">
                            <label for="reporterEmail" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="reporterEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="issueType" class="form-label">Issue Type</label>
                            <select class="form-select" id="issueType" required>
                                <option value="">-- Select Issue Type --</option>
                                <option value="hardware">Hardware Problem</option>
                                <option value="connectivity">Connectivity Problem</option>
                                <option value="performance">Performance Problem</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="issueDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="issueDescription" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="issueSeverity" class="form-label">Severity</label>
                            <select class="form-select" id="issueSeverity" required>
                                <option value="low">Low - Not urgent</option>
                                <option value="medium">Medium - Needs attention soon</option>
                                <option value="high">High - Urgent issue</option>
                                <option value="critical">Critical - Service is down</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitIssue">Submit Report</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle report submission
        document.getElementById('submitIssue').addEventListener('click', function() {
            const form = document.getElementById('issueForm');

            // Check if all required fields are filled
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (isValid) {
                // In a real application, you would submit the form data via AJAX here
                // For demo purposes, we'll just show an alert
                alert('Thank you for reporting this issue. Your report has been submitted.');

                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('reportIssueModal'));
                modal.hide();

                // Reset the form
                form.reset();
            }
        });
    </script>
</body>

</html>
