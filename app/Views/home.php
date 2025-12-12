<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VulnAPI - Security Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0d1117;
            --bg-secondary: #161b22;
            --bg-tertiary: #21262d;
            --border-color: #30363d;
            --text-primary: #e6edf3;
            --text-secondary: #8b949e;
            --accent-green: #3fb950;
            --accent-blue: #58a6ff;
            --accent-purple: #a371f7;
            --accent-orange: #d29922;
            --accent-red: #f85149;
            --accent-cyan: #39c5cf;
            --method-get: #3fb950;
            --method-post: #58a6ff;
            --method-patch: #d29922;
            --method-delete: #f85149;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .header {
            text-align: center;
            padding: 3rem 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 2rem;
            background: linear-gradient(135deg, rgba(248, 81, 73, 0.1) 0%, rgba(88, 166, 255, 0.1) 100%);
            border-radius: 16px;
        }

        .logo {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent-red), var(--accent-orange), var(--accent-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .logo-icon {
            font-size: 2.5rem;
            margin-right: 0.5rem;
        }

        .tagline {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .warning-banner {
            background: rgba(248, 81, 73, 0.15);
            border: 1px solid var(--accent-red);
            border-radius: 8px;
            padding: 1rem 1.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
        }

        .warning-banner svg {
            flex-shrink: 0;
        }

        .reset-btn {
            margin-top: 1.5rem;
            background: linear-gradient(135deg, var(--accent-orange), var(--accent-red));
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            color: white;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .reset-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(248, 81, 73, 0.4);
        }

        .reset-btn:active {
            transform: translateY(0);
        }

        .reset-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .reset-status {
            margin-top: 0.75rem;
            font-size: 0.9rem;
            min-height: 1.5rem;
        }

        .reset-status.success {
            color: var(--accent-green);
        }

        .reset-status.error {
            color: var(--accent-red);
        }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            transition: transform 0.2s, border-color 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: var(--accent-blue);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-cyan);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Section */
        .section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title svg {
            color: var(--accent-purple);
        }

        /* Endpoint Groups */
        .endpoint-group {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .group-header {
            padding: 1rem 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-tertiary);
            transition: background 0.2s;
        }

        .group-header:hover {
            background: #282e36;
        }

        .group-title {
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .group-tag {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .tag-vuln {
            background: rgba(248, 81, 73, 0.2);
            color: var(--accent-red);
        }

        .tag-auth {
            background: rgba(63, 185, 80, 0.2);
            color: var(--accent-green);
        }

        .chevron {
            transition: transform 0.3s;
        }

        .group-header.active .chevron {
            transform: rotate(180deg);
        }

        .group-content {
            display: none;
            padding: 0;
        }

        .group-content.active {
            display: block;
        }

        /* Endpoints */
        .endpoint {
            border-top: 1px solid var(--border-color);
        }

        .endpoint-header {
            padding: 1rem 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: background 0.2s;
        }

        .endpoint-header:hover {
            background: rgba(88, 166, 255, 0.05);
        }

        .method {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.6rem;
            border-radius: 4px;
            min-width: 60px;
            text-align: center;
        }

        .method-get { background: rgba(63, 185, 80, 0.2); color: var(--method-get); }
        .method-post { background: rgba(88, 166, 255, 0.2); color: var(--method-post); }
        .method-patch { background: rgba(210, 153, 34, 0.2); color: var(--method-patch); }
        .method-delete { background: rgba(248, 81, 73, 0.2); color: var(--method-delete); }

        .endpoint-path {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            color: var(--text-primary);
            flex-grow: 1;
        }

        .endpoint-desc {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .endpoint-badges {
            display: flex;
            gap: 0.5rem;
        }

        .badge {
            font-size: 0.65rem;
            padding: 0.2rem 0.4rem;
            border-radius: 3px;
            font-weight: 500;
        }

        .badge-jwt {
            background: rgba(163, 113, 247, 0.2);
            color: var(--accent-purple);
        }

        .badge-vuln {
            background: rgba(248, 81, 73, 0.2);
            color: var(--accent-red);
        }

        .badge-public {
            background: rgba(63, 185, 80, 0.2);
            color: var(--accent-green);
        }

        .endpoint-details {
            display: none;
            padding: 1rem 1.5rem;
            background: var(--bg-primary);
            border-top: 1px solid var(--border-color);
        }

        .endpoint-details.active {
            display: block;
        }

        .detail-section {
            margin-bottom: 1rem;
        }

        .detail-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .code-block {
            background: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            overflow-x: auto;
            position: relative;
        }

        .code-block pre {
            margin: 0;
            white-space: pre-wrap;
            word-break: break-all;
        }

        .copy-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 0.35rem 0.6rem;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 0.75rem;
            transition: all 0.2s;
        }

        .copy-btn:hover {
            background: var(--accent-blue);
            color: white;
            border-color: var(--accent-blue);
        }

        .json-key { color: var(--accent-cyan); }
        .json-string { color: var(--accent-green); }
        .json-number { color: var(--accent-orange); }

        /* Users Table */
        .users-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .users-table th,
        .users-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .users-table th {
            background: var(--bg-tertiary);
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .users-table td {
            font-family: 'JetBrains Mono', monospace;
        }

        .role-badge {
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        .role-admin {
            background: rgba(248, 81, 73, 0.2);
            color: var(--accent-red);
        }

        .role-user {
            background: rgba(63, 185, 80, 0.2);
            color: var(--accent-green);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 2rem;
            color: var(--text-secondary);
            font-size: 0.85rem;
            border-top: 1px solid var(--border-color);
            margin-top: 3rem;
        }

        .footer a {
            color: var(--accent-blue);
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .logo {
                font-size: 2rem;
            }

            .endpoint-header {
                flex-wrap: wrap;
            }

            .endpoint-desc {
                width: 100%;
                margin-top: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo">
                <span class="logo-icon">🔓</span>VulnAPI
            </div>
            <p class="tagline">Intentionally Vulnerable REST API for Security Learning</p>
            <div class="warning-banner">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <span><strong>WARNING:</strong> Contains intentional vulnerabilities. DO NOT deploy to production!</span>
            </div>
            <form action="/api/debug/reset" method="POST" style="display: inline;" onsubmit="return confirmReset()">
                <input type="hidden" name="token" value="reset123">
                <button type="submit" class="reset-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M23 4v6h-6"></path>
                        <path d="M1 20v-6h6"></path>
                        <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                    </svg>
                    Reset Database
                </button>
            </form>
            <p id="reset-status" class="reset-status"></p>
        </header>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">10</div>
                <div class="stat-label">Vulnerabilities</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">16</div>
                <div class="stat-label">Endpoints</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">3</div>
                <div class="stat-label">Test Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">JWT</div>
                <div class="stat-label">Auth Method</div>
            </div>
        </div>

        <!-- Default Users -->
        <section class="section">
            <h2 class="section-title">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Test Users
            </h2>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Organization</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>userA@acme.com</td>
                        <td>password123</td>
                        <td><span class="role-badge role-user">user</span></td>
                        <td>Acme Corp (ID: 1)</td>
                    </tr>
                    <tr>
                        <td>userB@techstart.com</td>
                        <td>password123</td>
                        <td><span class="role-badge role-user">user</span></td>
                        <td>TechStart Inc (ID: 2)</td>
                    </tr>
                    <tr>
                        <td>admin@acme.com</td>
                        <td>password123</td>
                        <td><span class="role-badge role-admin">admin</span></td>
                        <td>Acme Corp (ID: 1)</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- API Endpoints -->
        <section class="section">
            <h2 class="section-title">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
                API Endpoints
            </h2>

            <!-- Auth Group -->
            <div class="endpoint-group">
                <div class="group-header" onclick="toggleGroup(this)">
                    <div class="group-title">
                        🔐 Authentication
                        <span class="group-tag tag-auth">Public</span>
                    </div>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <div class="group-content">
                    <!-- POST /api/auth/login -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-post">POST</span>
                            <span class="endpoint-path">/api/auth/login</span>
                            <span class="endpoint-desc">Login and get JWT token</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-public">Public</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X POST http://localhost:8080/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email": "userA@acme.com", "password": "password123"}'</pre>
                                </div>
                            </div>
                            <div class="detail-section">
                                <div class="detail-title">Response</div>
                                <div class="code-block">
                                    <pre>{
  <span class="json-key">"status"</span>: <span class="json-string">"success"</span>,
  <span class="json-key">"data"</span>: {
    <span class="json-key">"token"</span>: <span class="json-string">"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."</span>,
    <span class="json-key">"user"</span>: { <span class="json-key">"id"</span>: <span class="json-number">1</span>, <span class="json-key">"email"</span>: <span class="json-string">"userA@acme.com"</span>, <span class="json-key">"role"</span>: <span class="json-string">"user"</span> }
  }
}</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- POST /api/auth/register -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-post">POST</span>
                            <span class="endpoint-path">/api/auth/register</span>
                            <span class="endpoint-desc">Register new user</span>
                            <div class="endpoint-badges">
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X POST http://localhost:8080/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"email": "hacker@evil.com", "password": "test123", "role": "user"}'</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicles Group -->
            <div class="endpoint-group">
                <div class="group-header" onclick="toggleGroup(this)">
                    <div class="group-title">
                        🚗 Vehicles
                    </div>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <div class="group-content">
                    <!-- GET /api/vehicles -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-get">GET</span>
                            <span class="endpoint-path">/api/vehicles</span>
                            <span class="endpoint-desc">List all vehicles</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8080/api/vehicles</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GET /api/vehicles/{id} -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-get">GET</span>
                            <span class="endpoint-path">/api/vehicles/{id}</span>
                            <span class="endpoint-desc">Get vehicle by ID</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8080/api/vehicles/3</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- POST /api/vehicles -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-post">POST</span>
                            <span class="endpoint-path">/api/vehicles</span>
                            <span class="endpoint-desc">Create vehicle</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X POST http://localhost:8080/api/vehicles \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"make": "Hacked", "model": "Car", "year": 2024, "price": 1, "org_id": 2}'</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PATCH /api/vehicles/{id} -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-patch">PATCH</span>
                            <span class="endpoint-path">/api/vehicles/{id}</span>
                            <span class="endpoint-desc">Update vehicle</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X PATCH http://localhost:8080/api/vehicles/5 \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"price": 0.01, "owner_user_id": 1}'</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DELETE /api/vehicles/{id} -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-delete">DELETE</span>
                            <span class="endpoint-path">/api/vehicles/{id}</span>
                            <span class="endpoint-desc">Delete vehicle</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X DELETE -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8080/api/vehicles/5</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Group -->
            <div class="endpoint-group">
                <div class="group-header" onclick="toggleGroup(this)">
                    <div class="group-title">
                        👑 Admin
                    </div>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <div class="group-content">
                    <!-- GET /api/admin/users -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-get">GET</span>
                            <span class="endpoint-path">/api/admin/users</span>
                            <span class="endpoint-desc">List all users</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8080/api/admin/users</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DELETE /api/admin/users/{id} -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-delete">DELETE</span>
                            <span class="endpoint-path">/api/admin/users/{id}</span>
                            <span class="endpoint-desc">Delete user</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X DELETE -H "Authorization: Bearer FORGED_ADMIN_TOKEN" http://localhost:8080/api/admin/users/2</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GET /api/admin/stats -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-get">GET</span>
                            <span class="endpoint-path">/api/admin/stats</span>
                            <span class="endpoint-desc">System statistics</span>
                            <div class="endpoint-badges">
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl http://localhost:8080/api/admin/stats</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payments Group -->
            <div class="endpoint-group">
                <div class="group-header" onclick="toggleGroup(this)">
                    <div class="group-title">
                        💳 Payments
                    </div>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <div class="group-content">
                    <!-- POST /api/payments/checkout -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-post">POST</span>
                            <span class="endpoint-path">/api/payments/checkout</span>
                            <span class="endpoint-desc">Create payment</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X POST http://localhost:8080/api/payments/checkout \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"vehicle_id": 1, "amount": 0.01}'</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- POST /api/payments/webhook -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-post">POST</span>
                            <span class="endpoint-path">/api/payments/webhook</span>
                            <span class="endpoint-desc">Payment webhook</span>
                            <div class="endpoint-badges">
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X POST http://localhost:8080/api/payments/webhook \
  -H "Content-Type: application/json" \
  -d '{"event": "payment.completed", "payment_id": 1, "status": "pending"}'</pre>
                                    <div style="margin-top: 10px; font-size: 12px; color: #8b949e;">
                                        Available statuses: <code>pending</code>, <code>paid</code>, <code>failed</code>, <code>refunded</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Uploads Group -->
            <div class="endpoint-group">
                <div class="group-header" onclick="toggleGroup(this)">
                    <div class="group-title">
                        📁 Uploads
                    </div>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <div class="group-content">
                    <!-- POST /api/uploads -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-post">POST</span>
                            <span class="endpoint-path">/api/uploads</span>
                            <span class="endpoint-desc">Upload file</span>
                            <div class="endpoint-badges">
                                <span class="badge badge-jwt">JWT</span>
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X POST http://localhost:8080/api/uploads \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -F "file=@shell.php.jpg"</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GET /api/uploads -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-get">GET</span>
                            <span class="endpoint-path">/api/uploads</span>
                            <span class="endpoint-desc">List uploaded files</span>
                            <div class="endpoint-badges">
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl http://localhost:8080/api/uploads</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Debug Group -->
            <div class="endpoint-group">
                <div class="group-header" onclick="toggleGroup(this)">
                    <div class="group-title">
                        🔧 Debug
                    </div>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <div class="group-content">
                    <!-- POST /api/debug/reset -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-post">POST</span>
                            <span class="endpoint-path">/api/debug/reset</span>
                            <span class="endpoint-desc">Reset database</span>
                            <div class="endpoint-badges">
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Reset token: reset123</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl -X POST http://localhost:8080/api/debug/reset \
  -H "Content-Type: application/json" \
  -d '{"token": "reset123"}'</pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GET /api/debug/info -->
                    <div class="endpoint">
                        <div class="endpoint-header" onclick="toggleEndpoint(this)">
                            <span class="method method-get">GET</span>
                            <span class="endpoint-path">/api/debug/info</span>
                            <span class="endpoint-desc">System information</span>
                            <div class="endpoint-badges">
                            </div>
                        </div>
                        <div class="endpoint-details">
                            <div class="detail-section">
                                <div class="detail-title">Example Request</div>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                                    <pre>curl http://localhost:8080/api/debug/info</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- Footer -->
        <footer class="footer">
            <p>VulnAPI v1.0 | Built with CodeIgniter 4</p>
            <p style="margin-top: 0.5rem;">JWT Secret: <code style="color: var(--accent-red);">secret</code> | Reset Token: <code style="color: var(--accent-red);">reset123</code></p>
        </footer>
    </div>

    <script>
        function toggleGroup(header) {
            header.classList.toggle('active');
            const content = header.nextElementSibling;
            content.classList.toggle('active');
        }

        function toggleEndpoint(header) {
            const details = header.nextElementSibling;
            details.classList.toggle('active');
        }

        function copyCode(btn) {
            const codeBlock = btn.parentElement;
            const code = codeBlock.querySelector('pre').textContent;
            navigator.clipboard.writeText(code).then(() => {
                const originalText = btn.textContent;
                btn.textContent = 'Copied!';
                btn.style.background = 'var(--accent-green)';
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.style.background = '';
                }, 1500);
            });
        }

        // Open first group by default
        document.querySelector('.group-header').click();

        function confirmReset() {
            return confirm('Are you sure you want to reset the database? This will delete all data and reseed with defaults.');
        }

        // Check for reset result in URL
        const urlParams = new URLSearchParams(window.location.search);
        const resetResult = urlParams.get('reset');
        if (resetResult) {
            const status = document.getElementById('reset-status');
            if (resetResult === 'success') {
                status.textContent = '✓ Database reset successfully!';
                status.className = 'reset-status success';
            } else if (resetResult === 'error') {
                const msg = urlParams.get('msg') || 'Unknown error';
                status.textContent = '✗ Reset failed: ' + msg;
                status.className = 'reset-status error';
            }
            // Clean URL
            window.history.replaceState({}, '', '/');
        }
    </script>
    <style>
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spinning {
            animation: spin 1s linear infinite;
        }
    </style>
</body>
</html>

