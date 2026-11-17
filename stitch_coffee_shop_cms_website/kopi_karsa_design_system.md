---
name: "Kopi Karsa"
description: "A refined, warm editorial design system for a modern Indonesian specialty coffee profile website and integrated CMS."
---

## Overview

Kopi Karsa embodies a modern artisanal coffee sanctuary. The visual language bridges artisanal warmth and clean editorial structure. Designed for both customer-facing storytelling in Bahasa Indonesia and an intuitive, non-technical Content Management System for coffee shop owners. It balances generous whitespace, rich tactile typography, and deep espresso tones.

## Colors

The palette draws directly from roasted coffee tones, warm steamed milk cream, rich caramel accents, and dark charcoal readability.

- **Primary:** Deep espresso brown (#38251E), conveying craft, depth, and grounding authority.
- **Secondary:** Warm cream (#F5F0E8), providing an inviting organic backdrop.
- **Accent:** Caramel brown (#B98255), highlighting calls to action, badges, and key moments.
- **Neutral:** Warm beige (#D9C7B5) and dark charcoal (#292522) for clear structural framing and accessible text contrast.

```yaml
colors:
  espresso: "#38251E"
  cream: "#F5F0E8"
  caramel: "#B98255"
  beige: "#D9C7B5"
  charcoal: "#292522"
  accent: "#B98255"
  light:
    primary: "#38251E"
    on-primary: "#FFFFFF"
    primary-container: "#F5F0E8"
    on-primary-container: "#38251E"
    secondary: "#B98255"
    on-secondary: "#272727"
    secondary-container: "#EFE6DC"
    on-secondary-container: "#38251E"
    surface: "#FAF8F5"
    on-surface: "#292522"
    surface-variant: "#F3EDE4"
    on-surface-variant: "#5A4E47"
    outline: "#D9C7B5"
    outline-variant: "#E7DDD2"
    success: "#2E6B4A"
    on-success: "#FFFFFF"
    warning: "#B4691B"
    on-warning: "#101010"
    error: "#A32D2D"
    on-error: "#FFFFFF"
  dark:
    primary: "#E7DDD2"
    on-primary: "#241712"
    primary-container: "#4D362C"
    on-primary-container: "#F5F0E8"
    secondary: "#D4A57E"
    on-secondary: "#2E1C11"
    secondary-container: "#5C3E2A"
    on-secondary-container: "#FAF8F5"
    surface: "#1E1613"
    on-surface: "#F5F0E8"
    surface-variant: "#2C211C"
    on-surface-variant: "#D9C7B5"
    outline: "#5C4A40"
    outline-variant: "#3E3029"
    success: "#57AB7A"
    on-success: "#0E2B1B"
    warning: "#EAA655"
    on-warning: "#381E03"
    error: "#F28B82"
    on-error: "#3C0D0D"
```

## Typography

Pairing **Playfair Display** for high-impact editorial storytelling with **Poppins** for crisp, geometric clarity across navigation, product specs, and administrative CMS tables.

```yaml
typography:
  display-lg:
    fontFamily: "Playfair Display"
    fontSize: 48px
    fontWeight: 700
    lineHeight: 56px
    letterSpacing: -0.5px
  display-lg-mobile:
    fontFamily: "Playfair Display"
    fontSize: 32px
    fontWeight: 700
    lineHeight: 38px
    letterSpacing: -0.25px
  display-md:
    fontFamily: "Playfair Display"
    fontSize: 40px
    fontWeight: 600
    lineHeight: 48px
  display-md-mobile:
    fontFamily: "Playfair Display"
    fontSize: 28px
    fontWeight: 600
    lineHeight: 34px
  headline-lg:
    fontFamily: "Playfair Display"
    fontSize: 32px
    fontWeight: 600
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: "Playfair Display"
    fontSize: 24px
    fontWeight: 600
    lineHeight: 32px
  headline-md:
    fontFamily: "Playfair Display"
    fontSize: 24px
    fontWeight: 600
    lineHeight: 32px
  headline-sm:
    fontFamily: "Playfair Display"
    fontSize: 20px
    fontWeight: 600
    lineHeight: 28px
  title-lg:
    fontFamily: "Poppins"
    fontSize: 18px
    fontWeight: 600
    lineHeight: 26px
  title-md:
    fontFamily: "Poppins"
    fontSize: 16px
    fontWeight: 600
    lineHeight: 24px
  body-lg:
    fontFamily: "Poppins"
    fontSize: 16px
    fontWeight: 400
    lineHeight: 26px
  body-md:
    fontFamily: "Poppins"
    fontSize: 14px
    fontWeight: 400
    lineHeight: 22px
  body-sm:
    fontFamily: "Poppins"
    fontSize: 12px
    fontWeight: 400
    lineHeight: 18px
  label-lg:
    fontFamily: "Poppins"
    fontSize: 14px
    fontWeight: 600
    lineHeight: 20px
    letterSpacing: 0.5px
  label-md:
    fontFamily: "Poppins"
    fontSize: 12px
    fontWeight: 600
    lineHeight: 16px
    letterSpacing: 0.5px
  label-sm:
    fontFamily: "Poppins"
    fontSize: 11px
    fontWeight: 500
    lineHeight: 14px
    letterSpacing: 0.5px
```

## Layout & Spacing

A fluid responsive 12-column grid on desktop with max container width of 1280px. For administrative screens, a persistent 260px collapsible sidebar layout is utilized. Spacing relies on an 8px base rhythm.

```yaml
spacing:
  gutter-xs: 4px
  gutter-sm: 8px
  gutter-md: 16px
  gutter-lg: 24px
  gutter-xl: 32px
  section: 64px
  page-margin: 24px
```

## Elevation & Depth

Subtle, warm-tinted elevation using espresso-tinted ambient drop shadows rather than stark harsh blacks. Smooth layered card depths (surface to surface-variant) provide tactile warmth without clutter.

## Shapes

Soft, balanced corner radii that reinforce warmth without feeling playful or juvenile.

```yaml
rounded:
  sm: 4px
  DEFAULT: 8px
  md: 12px
  lg: 16px
  xl: 24px
  full: 9999px
```

## Motion & Micro-interaction

Understated and smooth. Transitions for dropdowns, drawers, and modal state toggles happen within 150ms to 250ms with a decelerating cubic-bezier curve.

```yaml
motion:
  state-change:
    duration: 150ms
    delay: 0ms
    timingFunction: ease-out
  surface-enter:
    duration: 250ms
    delay: 0ms
    timingFunction: cubic-bezier(0.2, 0, 0, 1)
  surface-exit:
    duration: 180ms
    delay: 0ms
    timingFunction: cubic-bezier(0.3, 0, 1, 1)
```

## Voice & Content Strategy

The public experience speaks in warm, artisanal Indonesian (*Bahasa Indonesia*) with an inviting tone: "Cerita dan Rasa dalam Setiap Cangkir". The Admin CMS interface provides clear, straightforward labels with immediate visual cues for live changes, draft badges, and product availability toggles.

## Components

Component implementations live as individual HTML sticker sheet files in
`components/`. Each file contains the canonical, styled HTML components with
`<!-- COMPONENT: name -->` comment markers. Read each file before use.

- **Button** → `@components/button.html`: `button-primary`, `button-icon`, `button-with-icon`
- **Card** → `@components/card.html`: `card-elevated`, `card-action`, `card-interactive`, `card-interactive-2`
- **Input Field** → `@components/input-field.html`: `input-field-text`, `input-field-icon`
- **Modal** → `@components/modal.html`: `modal-standard`, `modal-alert`, `modal-drawer`
- **Table** → `@components/table.html`: `table-standard`, `table-interactive`, `table-selectable`
