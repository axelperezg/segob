# Rollback Plan - Blade Migration

**Project:** SEGOB - Sistema de Gestión de Contenido Gubernamental
**Created:** 2025-11-29
**Purpose:** Document how to rollback the Blade migration at any point

---

## Quick Rollback Commands

### Rollback to Pre-Migration State
```bash
# Return to main branch
git checkout main

# Or return to the pre-migration tag
git checkout pre-blade-migration
```

### Rollback to Specific Phase
```bash
# List available tags
git tag

# Checkout specific phase tag
git checkout blade-migration-phase-1-complete
git checkout blade-migration-phase-2-complete
# etc...
```

---

## Dual Mode Configuration

During the migration, both Inertia.js and Blade coexist. You can switch between them using environment variables:

### Force All Routes to Use Inertia (Rollback)
```bash
# Edit .env file
USE_BLADE_ROUTES=false
DUAL_MODE=true

# Clear cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Force All Routes to Use Blade
```bash
# Edit .env file
USE_BLADE_ROUTES=true
DUAL_MODE=true
```

### Disable Dual Mode (After Full Migration)
```bash
# Edit .env file
DUAL_MODE=false
```

---

## Phase-by-Phase Rollback Strategy

### Phase 0: Preparation
**If problems occur in Phase 0:**
1. No routes have been migrated yet
2. Simply set `USE_BLADE_ROUTES=false` in `.env`
3. All pages will continue using Inertia

**To completely remove Phase 0 changes:**
```bash
git checkout pre-blade-migration
```

### Phase 1-5: Individual Page Migration
**If a specific page has issues:**
1. Remove the route from `config/migration.php` migrated_routes
2. The page will automatically fall back to Inertia
3. Fix the Blade version offline
4. Re-add to migrated_routes when ready

**Example:**
```php
// config/migration.php
'migrated_routes' => [
    'videos.show' => true,     // Keep this migrated
    // 'videos.index' => true, // Comment out to rollback this route
],
```

### Phase 6: Complete Removal of Inertia
**⚠️ WARNING: After Phase 6, rollback is more complex**

**To rollback after Phase 6:**
```bash
# Return to the last phase before cleanup
git checkout blade-migration-phase-5-complete

# Or restore from backup
# (You should create a full backup before Phase 6)
```

---

## Emergency Rollback Procedure

### If the site is down:

1. **Immediate fix (30 seconds):**
   ```bash
   # Switch back to main branch
   git checkout main

   # Restart services
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

2. **If migrations were run:**
   ```bash
   # Rollback database if needed
   php artisan migrate:rollback

   # Or restore from backup
   # mysql -u root -p segob < backup.sql
   ```

3. **Clear all caches:**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   php artisan optimize:clear
   ```

---

## Maintaining Dual Versions

During migration (Phases 1-5), you can maintain both versions:

### For Development
```env
DUAL_MODE=true
USE_BLADE_ROUTES=false  # Test Inertia version
# or
USE_BLADE_ROUTES=true   # Test Blade version
```

### For Staging
Deploy with `DUAL_MODE=true` and gradually test Blade pages:
```php
// config/migration.php
'migrated_routes' => [
    'videos.show' => true,     // Blade
    'videos.index' => true,    // Blade
    // Other routes use Inertia by default
],
```

---

## Backup Strategy

### Before Each Major Phase

**Phase 0 - Before Starting:**
```bash
# Create tag (already done)
git tag pre-blade-migration
```

**Phase 1-5 - After Each Phase:**
```bash
# Create tag
git tag blade-migration-phase-1-complete
git tag blade-migration-phase-2-complete
# etc.

# Push tags
git push origin --tags
```

**Phase 6 - Before Inertia Removal:**
```bash
# Create final backup
git tag pre-inertia-removal

# Database backup
mysqldump -u root -p segob > backup_pre_inertia_removal.sql

# Files backup
tar -czf backup_pre_inertia_removal.tar.gz \
    resources/js \
    resources/views/app.blade.php \
    app/Http/Middleware/HandleInertiaRequests.php \
    package.json \
    vite.config.js
```

---

## Database Rollback

### If database migrations were added:
```bash
# List migrations
php artisan migrate:status

# Rollback last migration
php artisan migrate:rollback

# Rollback specific batch
php artisan migrate:rollback --batch=2

# Rollback all migrations
php artisan migrate:reset
```

### Restore from backup:
```bash
# MySQL
mysql -u root -p segob < backup.sql

# Run migrations fresh
php artisan migrate:fresh --seeder=DefaultDataSeeder
```

---

## Asset Rollback

### If Vite build fails:

**Restore old assets:**
```bash
# Checkout old vite.config.js
git checkout main -- vite.config.js

# Checkout old package.json
git checkout main -- package.json

# Reinstall dependencies
npm ci

# Rebuild assets
npm run build
```

**Remove Alpine.js/Swiper:**
```bash
npm uninstall alpinejs swiper
npm ci
```

---

## Testing Rollback

### Before deploying to production:

1. **Test rollback locally:**
   ```bash
   # Switch to Blade
   USE_BLADE_ROUTES=true php artisan serve

   # Switch back to Inertia
   USE_BLADE_ROUTES=false php artisan serve
   ```

2. **Verify both work:**
   - All pages load without errors
   - Navigation works correctly
   - Assets load properly
   - JavaScript works

3. **Test database rollback:**
   ```bash
   # Backup current state
   php artisan migrate:status > migration_status.txt

   # Rollback
   php artisan migrate:rollback

   # Re-migrate
   php artisan migrate
   ```

---

## Feature Flags (Alternative to Environment Variables)

### Using route-based flags:

Instead of environment variables, you can use route parameters:

```php
// routes/web.php
Route::get('/videos/{video:slug}', [VideoController::class, 'show'])
    ->name('videos.show')
    ->defaults('blade', true); // Force Blade

Route::get('/noticias', NewsController::class)
    ->name('news.index')
    ->defaults('blade', false); // Force Inertia
```

Then in middleware:
```php
if ($request->route()->getDefault('blade')) {
    // Use Blade
} else {
    // Use Inertia
}
```

---

## Communication Plan

### If rollback is needed in production:

1. **Notify team immediately**
2. **Document the issue** (what failed, when, why)
3. **Execute rollback** (using commands above)
4. **Verify site is working**
5. **Post-mortem** (why did it fail, how to prevent)

---

## Rollback Checklist

Before rolling back, verify:

- [ ] Database backup exists
- [ ] Git branch is up to date
- [ ] Team is notified (if production)
- [ ] Cache is cleared
- [ ] Assets are rebuilt
- [ ] Tests are passing
- [ ] Site is accessible
- [ ] No errors in logs

After rollback:

- [ ] Site is working
- [ ] All pages load correctly
- [ ] JavaScript works
- [ ] Images load
- [ ] Forms submit correctly
- [ ] Tests pass
- [ ] Logs are clean

---

## Long-term Maintenance

### After successful migration:

1. **Keep Inertia code for 1 month** (in a branch)
2. **Monitor error logs** closely
3. **Keep database backups** for 3 months
4. **Document issues** and solutions
5. **Update this document** with lessons learned

---

**Last Updated:** 2025-11-29
**Maintained by:** Development Team
