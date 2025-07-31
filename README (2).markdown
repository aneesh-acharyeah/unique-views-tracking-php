# Unique Views Tracking System (PHP)

A PHP-based system to track **unique page views** using cookies, IP addresses, and MySQL. It ensures each visitor is counted once per page within a specified time frame.

## Features

- Tracks unique page views using cookies and IP-based deduplication.
- Stores view data in a MySQL database for persistence.
- Configurable cookie expiration for flexible tracking periods.
- Adaptable for multiple pages with dynamic `page_id`.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Database Setup](#database-setup)
- [Cookie Expiry](#cookie-expiry)
- [License](#license)

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/unique-views-tracking.git
   cd unique-views-tracking
   ```

2. **Database Setup**:
   - Create a MySQL database.
   - Import the `page_views` table using the SQL query below.
   - Update database credentials in the PHP script (e.g., `config.php`).

## Usage

1. **Set Up the PHP Script**:
   - Include `unique-views.php` on pages you want to track.
   - Set `page_id` dynamically, e.g.:
     ```php
     $page_id = isset($_GET['page_id']) ? (int)$_GET['page_id'] : 123;
     ```

2. **Integrate with Your Website**:
   - Add the script at the top of each tracked page.
   - The script handles unique view tracking automatically.

## Database Setup

Run this SQL query to create the `page_views` table:

```sql
CREATE TABLE `page_views` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `page_id` INT(11) NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `view_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_view` (`page_id`, `ip_address`)
);
```

### Table Structure
- `id`: Auto-incremented primary key.
- `page_id`: Page identifier.
- `ip_address`: Visitor’s IP address (supports IPv4/IPv6).
- `view_time`: Timestamp of the view.

## Cookie Expiry

Cookies expire in **1 year** by default. Adjust in the `setcookie()` function:

```php
setcookie("viewed_page_$page_id", "1", time() + 60 * 60 * 24 * 365, "/"); // 1 year
```

For a shorter period, e.g., 1 week:

```php
setcookie("viewed_page_$page_id", "1", time() + 60 * 60 * 24 * 7, "/"); // 1 week
```

## License

MIT License. See [LICENSE](LICENSE) for details.