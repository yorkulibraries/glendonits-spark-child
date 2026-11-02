# Glendon ITS SPARK Child

A minimal child theme named `glendonits-spark-child`, inheriting from
`glendonits-spark-20151125`. WordPress will use the parent's templates and
functions unless an individual file is added here to override it. This
preserves the existing SPARK page flow, sidebars, ACF fields, menus, and York
header while providing a safe place for incremental redesign.

## Activation checklist

1. Keep `glendonits-spark-20151125` installed and activate **Glendon ITS SPARK Child**.
2. Verify the SPARK homepage and representative module pages in English and
   French.
3. Check menu assignments under **Appearance → Menus → Manage Locations**;
   WordPress stores menu-location assignments per theme.
4. Confirm ACF fields, resources, and optional page elements still render.
5. Add child-specific CSS and templates here rather than editing the parent.

## Bootstrap

The parent currently ships its own Bootstrap CSS and JavaScript. This child
does not enqueue another Bootstrap version. A Bootstrap 5 migration should be
planned separately: first inventory Bootstrap 3 classes and jQuery-dependent
components, then migrate and validate templates before removing the parent's
Bootstrap assets. Do not load Bootstrap 3 and 5 globally together.

## Scope

This is a child-theme starting point, not the responsive redesign itself. The
parent's fixed-width SPARK layout and existing interactions remain in effect
until they are specifically overridden or replaced in the child.
